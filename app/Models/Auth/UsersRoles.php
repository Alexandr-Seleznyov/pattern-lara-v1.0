<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class UsersRoles extends Model
{
    protected $table = 'users_roles';
    protected $fillable = [
        'users_id',
        'roles_id',
    ];


    public function roles()
    {
        return $this->belongsTo('App\Models\Auth\Roles', 'roles_id')->withDefault();
    }


//    public function users()
//    {
//        return $this->belongsTo('App\Models\Auth\Users', 'users_id')->withDefault();
//    }

}
