<?php

namespace App\Http\Controllers;

use App\Album;
use App\ImageThumbnail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use KekoApp\LaravelMetaTags\Facades\MetaTag;

class GuestController extends Controller
{
    public function showAsGuest(Request $request, User $user) {
        $os = null;

        $iPod = stripos($request->header('User-Agent'), 'iPod');
        $iPhone = stripos($request->header('User-Agent'), 'iPhone');
        $iPad = stripos($request->header('User-Agent'), 'iPad');
        $android = stripos($request->header('User-Agent'), 'Android');

        if($iPod || $iPhone || $iPad) {
            $request->session()->put('operating_system', 'iOS');
            $os = 'iOS';

        } else if($android) {
            $request->session()->put('operating_system', 'android');
            $os = 'android';
        } else {
            $request->session()->put('operating_system', 'pc');
            $os = 'pc';
        }
        $host = $request->getHttpHost();

        $latestNullAlbums = Album::where('title', null)->where('user_id', $user->id)->get();
        if($latestNullAlbums != null) {
            foreach ($latestNullAlbums as $latestNullAlbum) {
                if(file_exists(public_path('uploaded_images/' . $user->email . '/' . $latestNullAlbum->id))) {
                    File::deleteDirectory(public_path('uploaded_images/' . $user->email . '/' . $latestNullAlbum->id));
                }
                if(file_exists(public_path('image_thumbnails/' . $user->email . '/' . $latestNullAlbum->id))) {
                    File::deleteDirectory(public_path('image_thumbnails/' . $user->email . '/' . $latestNullAlbum->id));
                }
                $latestNullAlbum->delete();
            }
        }

        $albums = DB::table('albums')->where('user_id', $user->id)->where('is_published', 1)->paginate(6);
        $imageThumbnails = ImageThumbnail::all();
        return view('guest.guest_preview', compact('user', 'albums', 'imageThumbnails', 'os','host'));
    }

    public function showcaseAlbum(Request $request, Album $album) {
        if(!Auth::guest()) {
            if(Auth::user()->id == $album->user_id) {
                return redirect()->route('album.show', $album->id);
            }
        }

        $coverImage = ImageThumbnail::findOrFail($album->album_cover_id);

        if(!Auth::guest()) {
            foreach (Auth::user()->purchased_albums as $purchased_album)  {
                if($purchased_album->id == $album->id) {
                    return redirect()->route('showcase_album', $album->id);
                }
            }
        }
        $user = User::findOrFail($album->user_id);
        $currency = $user->currency;
//        $images = $album->images;
        $imageThumbnails = $album->image_thumbnails()->orderBy('thumbnail_name', 'asc')->get();
        $host = $request->getHttpHost();

        return view('guest.guest_album_preview', compact('album', 'imageThumbnails', 'user', 'purchasedAlbums', 'status', 'currency', 'coverImage', 'host'));
    }
}
