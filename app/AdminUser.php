<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{

    protected $table = 'admin_users';

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'remember_token'
    ];

    protected $hidden = [
        'remember_token', 'password'
    ];
}
