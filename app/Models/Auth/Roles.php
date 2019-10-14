<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'id',
        'title',
        'description',
    ];


}
