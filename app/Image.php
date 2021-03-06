<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'file_name',
        'path',
        'size',
        'album_id',
        'alias',
        'image_thumbnail_id',
    ];

    public function album() {
        return $this->belongsTo(Album::class);
    }

    public function image_thumbnail() {
        return $this->hasOne(ImageThumbnail::class);
    }

//    public function image_thumbnail() {
//        return $this->hasOne(ImageThumbnail::class);
//    }
}
