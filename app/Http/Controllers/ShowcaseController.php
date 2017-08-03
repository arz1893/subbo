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
        $imageThumbnails = ImageThumbnail::where('album_id', $album->id)->get();
        $purchasedAlbums = Auth::user()->purchased_albums()->get();
        $status = false;

        foreach ($purchasedAlbums as $purchasedAlbum) {
            if($purchasedAlbum->id == $album->id) {
                $status = true;
            }
        }

        return view('showcase.showcase_album', compact('album', 'imageThumbnails', 'user', 'purchasedAlbums', 'status', 'currency'));
    }
}
