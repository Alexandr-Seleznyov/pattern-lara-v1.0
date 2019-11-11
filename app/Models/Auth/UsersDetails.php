<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class UsersDetails extends Model
{
    protected $table = 'users_details';
    protected $fillable = [
        'users_id',
        'last_name',
        'patronymic',
        'gender',
        'date_birthday',
        'phone',
    ];


    public function users()
    {
        return $this->belongsTo('App\Models\Auth\Users', 'users_id')->withDefault();
    }

}
