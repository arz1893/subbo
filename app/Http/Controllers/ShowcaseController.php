<?php

namespace App\Http\Controllers;

use App\Album;
use App\ImageThumbnail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowcaseController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function showcaseAlbum(Album $album) {
        $user = User::findOrFail($album->user_id);
        $currency = $user->currency;
        $images = $album->images;
        $imageThumbnails = $album->image_thumbnails->orderBy('thumbnail_name', 'asc')->get();
        $purchasedAlbums = Auth::user()->purchased_albums()->get();
        $status = false;

        foreach ($purchasedAlbums as $purchasedAlbum) {
            if($purchasedAlbum->id == $album->id) {
                $status = true;
            }
        }

        if($status == true) {
            $coverImage = ImageThumbnail::findOrFail($album->album_cover_id);
            return view('showcase.showcase_album', compact('album', 'coverImage', 'images', 'user', 'purchasedAlbums', 'status', 'currency'));
        } else {
            return view('showcase.showcase_album', compact('album', 'imageThumbnails', 'user', 'purchasedAlbums', 'status', 'currency'));
        }

    }
}
