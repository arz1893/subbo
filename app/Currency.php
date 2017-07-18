<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'currency';

    protected $fillable = [
        'country',
        'currency',
        'code',
        'symbol'
    ];

    public function users() {
        return $this->hasMany(User::class);
    }
}
