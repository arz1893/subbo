<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaypalInvoice extends Model
{
    protected $table = 'paypal_invoices';

    protected $fillable = [
        'album_id', 'user_id', 'payer_id', 'payment_id', 'payment_token'
    ];

    public function albums() {
        return $this->hasMany(Album::class, 'album_id');
    }

    public function users() {
        return $this->hasMany(User::class, 'user_id');
    }
}
