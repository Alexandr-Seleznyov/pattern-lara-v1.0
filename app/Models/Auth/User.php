<?php

namespace App\Models\Auth;

use App\Http\Helpers\ObjectsApi;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function usersRoles()
    {
        return $this->hasMany('App\Models\Auth\UsersRoles', 'users_id');
    }


    /**
     * Get array of models roles
     *
     * @return array
     */
    public function roles()
    {
        $ur = $this->usersRoles;
        $rolesArray = [];

        foreach($ur as $value){
            $rolesArray[] = $value->roles;
        }

        return $rolesArray;
    }


    /**
     * Get array of ID roles
     *
     * @return array
     */
    public function getRolesID()
    {
        $ur = $this->usersRoles;
        $rolesArrayID = [];

        foreach($ur as $value){
            $rolesArrayID[] = $value->roles->id;
        }

        return $rolesArrayID;
    }



    /**
     * @return boolean
     */
    public function isBackAndFront()
    {
        $rolesID = $this->getRolesID();

        if(in_array(1, $rolesID)) return true;  // Super Admin
        if(in_array(5, $rolesID)) return false; // Banned
        if(in_array(2, $rolesID)) return true;  // Admin
        if(in_array(4, $rolesID)) return true;  // Content
        if(in_array(3, $rolesID)) return false; // User

        return false;
    }


    /**
     * @return boolean
     */
    public function isBack()
    {
        return $this->isBackAndFront();
    }


    /**
     * @return boolean
     */
    public function isFront()
    {
        $rolesID = $this->getRolesID();

        if($this->isBackAndFront()) {
            return true;
        } else {
            if(count($rolesID) == 0) return true; // User
            return in_array(3, $rolesID); // User
        }

    }

    /**
     * @return boolean
     */
    public function isSuperAdmin()
    {
        $rolesID = $this->getRolesID();
        if(in_array(1, $rolesID)) return true;  // Super Admin

        return false;
    }


    /**
     * @return boolean
     */
    public function isAdmin()
    {
        $rolesID = $this->getRolesID();
        if(in_array(5, $rolesID)) return false; // Banned
        if(in_array(2, $rolesID)) return true;  // Admin

        return false;
    }


    /**
     * @return array
     */
    public function getAccessApi($objectApiName, $action, $id = null)
    {
        $objectsApi = new ObjectsApi($this);

        return $objectsApi->getAccessApi($objectApiName, $action, $id);
    }
}
