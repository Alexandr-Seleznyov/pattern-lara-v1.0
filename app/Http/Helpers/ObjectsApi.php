<?php

namespace App\Http\Helpers;


use App\Models\Auth\User;

class ObjectsApi
{
    /**
     * @var User
     */
    protected $userCurrent;


    public function __construct(User $userCurrent)
    {
        $this->userCurrent = $userCurrent;
    }



    /**
     * @param $objectApiName string
     * @param $action string 'select'|'update'|'insert'|'delete'
     * @param null $id
     * @return array
     */
    public function getAccessApi($objectApiName, $action, $id = null)
    {
        if ($this->userCurrent->isSuperAdmin()) return ['status' => true];

//        return [
//            'status' => false,
//            'curent_id' => $this->userCurrent->id,
//            'isSuperAdmin' => $this->userCurrent->isSuperAdmin()
//        ];

        $result = [
            'status' => false,
            'message' => 'Access denied'
        ];

        if ($this->userCurrent->isAdmin()){

            switch ($objectApiName){
                case 'Users' :
                    $result = $this->getAccessApiAdminUser($action, $id);
                    break;
            }

        }

        return $result;
    }



    /**
     * Доступы запросов обычного администратора к объекту Users
     *
     * @param $action string
     * @param null $id integer
     * @return array
     */
    public function getAccessApiAdminUser($action, $id = null)
    {
        $resultFalse = [
            'status' => false,
            'message' => 'Access denied'
        ];

        $resultTrue = ['status' => true];

        $isSuperAdmin = false;
        $isAdmin = false;
        $isCurrent = false;

        if(isset($id)){
            $user = User::find($id);
            if(isset($user)){
                $isSuperAdmin = $user->isSuperAdmin();
                $isAdmin = $user->isAdmin();
                $isCurrent = $this->userCurrent->id == $id;
            }
        }

        if($isSuperAdmin) return $resultFalse; // Никаких запросов к суперадмину

        switch ($action){
            case 'select' :
                return $resultTrue;
                break;
            case 'update' :
                if(!$isAdmin) return $resultTrue; // Админов не изменяем
                if($isCurrent) return $resultTrue; // Себя изменяем
                break;
            case 'insert' :
                if(!$isAdmin) return $resultTrue; // Админов не создаём
                break;
            case 'delete' :
                if(!$isAdmin) return $resultTrue; // Админов не удаляем
                break;
        }

        return $resultFalse;
    }
}