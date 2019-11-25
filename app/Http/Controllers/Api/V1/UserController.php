<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Auth\Roles;
use App\Models\Auth\User;
use App\Models\Auth\UsersDetails;
use App\Models\Auth\UsersRoles;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private $objectApiName = 'Users';


    public function index(Request $request)
    {
        $currentPage = 1;
        $count = 25;

        if($request->has('current_page')) $currentPage = (int) $request->get('current_page');
        if($request->has('count')) $count = (int) $request->get('count');

        $rolesAll = Roles::all();

        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $users = new User();

        if($request->has('filter')) {
            $filters = json_decode($request->get('filter'), true);
            $users = $this->setFilterUsers($users, $filters);
        }

        if($request->has('sort')) {
            $sort = json_decode($request->get('sort'), true);
            $users = $this->setSortUsers($users, $sort);
        }

        $paginator = $users->paginate($count);


        $paginator->getCollection()->transform(function ($value) {
            return $this->getUserFull($value);
        });

        $currentUser = $request->user();

        $response = [
            'pagination' => [
                'total' => $paginator->total(),
                'per_page' => $paginator->perPage(),
                'current_page' => $paginator->currentPage(),
//                'last_page' => $paginator->lastPage(),
//                'from' => $paginator->firstItem(),
//                'to' => $paginator->lastItem()
            ],
            'roles_all' => $rolesAll,
            'data' => $paginator,
            'current_user' => $currentUser,
            'current_roles' => $currentUser->roles()
        ];

        return json_encode($response);
    }




    public function show($id)
    {
        $user = User::findOrFail($id);
        $rolesAll = Roles::all();

        $response = [
            'user' => $this->getUserFull($user),
            'roles' => $user->roles(),
            'roles_all' => $rolesAll,
        ];

        return json_encode($response);
    }



    public function update(Request $request, $id)
    {
        $action = 'update';
        $userCurrent = $request->user();
        $accessApi = $userCurrent->getAccessApi($this->objectApiName, $action, $id);

        if($accessApi['status']){
            $user = User::findOrFail($id);
            $usersDetails = $user->usersDetails;

            $validateDate = $request->validate([
                'name' => 'required|max:55',
                'email' => 'required|email|unique:users,email,'.$id,
                'last_name' => ['string', 'max:50', 'nullable'],
                'patronymic' => ['string', 'max:50', 'nullable'],
                'gender' => ['string', Rule::in('male','female'), 'nullable'],
                'date_birthday' => ['date', 'date_format:Y-m-d', 'nullable'],
            ]);

            $user->update($validateDate);
            $usersDetails->update($validateDate);

            return $user;
        }

        return json_encode($accessApi);
    }






    public function store(Request $request)
    {
        $validateDate = $request->validate([
            'name' => 'required|max:55',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',

            'last_name' => ['string', 'max:50', 'nullable'],
            'patronymic' => ['string', 'max:50', 'nullable'],
            'gender' => ['string', Rule::in('male','female'), 'nullable'],
            'date_birthday' => ['date', 'date_format:Y-m-d', 'nullable'],
        ]);


        $user = null;
        $isError = false;
        $message = null;

        try {
            DB::transaction(function () use ($validateDate, &$user) {
                $user = User::create($validateDate);

                $validateDate['users_id'] = $user->id;

                UsersDetails::create($validateDate);
            });
        } catch (\Exception $e) {
            $isError = true;
            $message = $e;
        } catch (\Throwable $e) {
            $isError = true;
            $message = $e;
        }

        if($isError) {
            return json_encode(['error' => $message]);
        }

        return $user;
    }






    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return '';
    }



    // For Demo
    public function get(Request $request)
    {
        $user_id = $request->get("uid", 0);
        $user = User::find($user_id);
        return $user;
    }


//$newValue['email_verified_at'] = date("Y-m-d", strtotime($value->email_verified_at));
//$newValue['updated_at'] = date("Y-m-d", strtotime($value->updated_at));
//$newValue['created_at'] = date("Y-m-d", strtotime($value->created_at));


    public function setFilterUsers($users, $filters)
    {
        $fieldsUsers = [
            'id',
            'email',
        ];

        $fieldsUsersDetails = [
            'last_name'
        ];

        $users = $users->join('users_details as ud','users.id', '=', 'ud.users_id');

        foreach($fieldsUsers as $value){
            if(array_key_exists($value, $filters)){
                if(isset($filters[$value])) $users = $users->where('users.'.$value, 'like', '%'.$filters[$value].'%');
            };
        }

        foreach($fieldsUsersDetails as $value){
            if(array_key_exists($value, $filters)){
                if(isset($filters[$value])) $users = $users->where('ud.'.$value, 'like', '%'.$filters[$value].'%');
            };
        }

        if(array_key_exists('is_verified', $filters)){
            if(isset($filters['is_verified']) && $filters['is_verified'] != 0)
                if($filters['is_verified'] == 1) $users = $users->whereNotNull('users.email_verified_at');
                else $users = $users->whereNull('users.email_verified_at');
        };

        if(array_key_exists('role_id', $filters)){
            if(isset($filters['role_id']) && $filters['role_id'] != 0) $users = $this->setFiltersRole($users, (int) $filters['role_id']);
        };

        if(array_key_exists('date_start', $filters)){
            if(isset($filters['date_start'])) $users = $users->whereDate('ud.created_at', '>=', $filters['date_start']);
        };

        if(array_key_exists('date_end', $filters)){
            if(isset($filters['date_end'])) $users = $users->whereDate('ud.created_at', '<=', $filters['date_end']);
        };


        return $users;
    }




    public function setFiltersRole($users, $roleId){
        $usersId = [];

        $usersRoles = UsersRoles::where('roles_id', $roleId)->get();
        foreach($usersRoles as $values){
            $usersId[] = (int) $values->users_id;
        }


        if ($roleId == 3){
            $usersRoles = UsersRoles::where('roles_id', 1)
                ->orWhere('roles_id', 2)
                ->orWhere('roles_id', 4)
                ->get();
            foreach($usersRoles as $value){
                if(!in_array((int) $value->users_id, $usersId)){
                    $users = $users->where('users.id', '<>', $value->users_id);
                };
            }
        } else {
            foreach ($usersId as $value){
                $users = $users->where('users.id', $value);
            }
        };


        return $users;
    }



    public function setSortUsers($users, $sort)
    {
        if(isset($sort['field']) && isset($sort['sort_type'])) {
            $tab = '';
            switch ($sort['field']) {
                case 'id': $tab = 'users'; break;
                case 'full_name': $sort['field'] = 'last_name'; $tab = 'ud'; break;
                case 'email': $tab = 'users'; break;
                case 'created_at': $tab = 'ud'; break;
            }


            if ($sort['sort_type'] == 'up') $users = $users->orderBy($tab.'.'.$sort['field']);
            if ($sort['sort_type'] == 'down') $users = $users->orderBy($tab.'.'.$sort['field'], 'desc');
        }

        return $users;
    }


    public function getUserFull(User $user)
    {
        if (!isset($user->id)) return $user;

        $userFull = [];

        $userFull['id'] = $user->id;
        $userFull['name'] = $user->name;
        $userFull['email'] = $user->email;
        $userFull['email_verified_at'] = isset($user->email_verified_at) ? date("Y-m-d", strtotime($user->email_verified_at)) : null;
        $userFull['updated_at'] = isset($user->usersDetails->updated_at) ? date("Y-m-d", strtotime($user->usersDetails->updated_at)) : null;
        $userFull['created_at'] = isset($user->usersDetails->created_at) ? date("Y-m-d", strtotime($user->usersDetails->created_at)) : null;

        $userFull['last_name'] = $user->usersDetails->last_name;
        $userFull['patronymic'] = $user->usersDetails->patronymic;
        $userFull['gender'] = $user->usersDetails->gender;
        $userFull['date_birthday'] = date("Y-m-d", strtotime($user->usersDetails->date_birthday));
        $userFull['phone'] = $user->usersDetails->phone;
        $userFull['roles'] = $user->roles();

        return $userFull;
    }

}
