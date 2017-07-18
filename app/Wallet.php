<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'deposit',
        'withdraw',
        'user_id'
    ];

    public function user() {
        return $this->hasOne(User::class);
    }
}
