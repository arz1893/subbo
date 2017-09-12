<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageThumbnail extends Model
{
    protected $fillable = [
        'thumbnail_name',
        'thumbnail_path',
        'thumbnail_size',
        'alias',
        'image_id',
        'album_id',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function image() {
        return $this->belongsTo(Image::class);
    }

    public function album() {
        return $this->belongsTo(Album::class);
    }
}
