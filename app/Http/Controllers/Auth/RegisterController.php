<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Auth\UsersDetails;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }




    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],

            'last_name' => ['string', 'max:50', 'nullable'],
            'patronymic' => ['string', 'max:50', 'nullable'],
            'gender' => ['string', Rule::in('male','female'), 'nullable'],
            'date_birthday' => ['date', 'date_format:Y-m-d', 'nullable'],
        ]);
    }




    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Auth\User
     */
    protected function create(array $data)
    {
        $user = null;
        $isError = false;
        $message = null;

        try {
            DB::transaction(function () use ($data, &$user) {
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                ]);

                UsersDetails::create([
                    'users_id' => $user->id,
                    'last_name' => $data['last_name'] ?? null,
                    'patronymic' => $data['patronymic'] ?? null,
                    'gender' => $data['gender'] ?? null,
                    'date_birthday' => $data['date_birthday'] ?? null,
                    'phone' => $data['phone'] ?? null,
                ]);
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
}
