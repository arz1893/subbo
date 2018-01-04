<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'provider_name',
        'facebook_id',
        'twitter_id',
        'google_id',
        'avatar',
        'user_type_id',
        'about',
        'phone_number',
        'currency_id',
        'bank_name',
        'account_number',
        'wallet_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function albums() {
        return $this->hasMany(Album::class);
    }

    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    public function wallet() {
        return $this->hasOne(Wallet::class);
    }

    public function purchased_albums() {
        return $this->belongsToMany(Album::class, 'order_history', 'user_id', 'album_id')
                    ->withTimestamps()
                    ->withPivot('created_at');
    }

    public function image_thumbnails() {
        return $this->hasMany(ImageThumbnail::class);
    }

    public function withdraw_requests() {
        return $this->hasMany(WithdrawRequest::class);
    }
}
