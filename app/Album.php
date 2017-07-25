<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'id', 'title','description','price','user_id', 'album_cover_id', 'views', 'downloaded', 'is_published', 'is_deleted'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function categories() {
        return $this->belongsToMany('App\Category', 'album_category')->withTimestamps();
    }

    public function getCategoryListAttribute() {
        return $this->categories()->pluck('id')->all();
    }

    public function images() {
        return $this->hasMany(Image::class);
    }


    public function image_thumbnails() {
        return $this->hasMany(ImageThumbnail::class);
    }

    public function purchased_albums() {
        return $this->belongsToMany(User::class, 'order_history', 'album_id', 'user_id')
                    ->withTimestamps()
                    ->withPivot('created_at');
    }
//
//    public function images() {
//        return $this->hasMany(Image::class);
//    }
//
//    public function image_thumbnails() {
//        return $this->hasMany(ImageThumbnail::class);
//    }
}
