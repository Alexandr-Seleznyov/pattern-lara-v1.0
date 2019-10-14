<?php

namespace App\Models\Auth;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

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
    public function rolesID()
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
        $result = false;
        $rolesArrayID = $this->rolesID();

        if(in_array(1, $rolesArrayID)) return true;  // Super Admin
        if(in_array(5, $rolesArrayID)) return false; // Banned
        if(in_array(2, $rolesArrayID)) return true;  // Admin
        if(in_array(4, $rolesArrayID)) return true;  // Content
        if(in_array(3, $rolesArrayID)) return false; // User

        return $result;
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
        if($this->isBackAndFront()) {
            return true;
        } else {
            $rolesArrayID = $this->rolesID();
            return in_array(3, $rolesArrayID); // User
        }

    }
}
