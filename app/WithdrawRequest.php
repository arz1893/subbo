<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    protected $fillable = [
        'amount',
        'user_id',
        'is_approved'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
