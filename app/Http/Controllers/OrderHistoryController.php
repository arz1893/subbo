<?php

namespace App\Http\Controllers;

use App\Album;
use App\ImageThumbnail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderHistoryController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function showOrderHistory(Request $request, User $user) {

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

        if($request->search_purchased != null) {
            $purchasedAlbums = $user->purchased_albums()->where('title', 'like', '%' . $request->search_purchased . '%')->paginate(6);
        } else {
            $purchasedAlbums = $user->purchased_albums()->paginate(6);
            $currency = $user->currency;
        }
        $host = $request->getHttpHost();
        return view('order_history.show_order_history', compact('user', 'purchasedAlbums', 'currency', 'host', 'os'));
    }

    public function showSoldAlbumHistory(User $user) {
        $userAlbums = Album::where('user_id', $user->id)->get();
        $currency = $user->currency;
        $imageThumbnails = DB::table('image_thumbnails')->where('user_id', $user->id)->get();
        return view('order_history.show_sold_album_history', compact('userAlbums','imageThumbnails', 'currency'));
    }

    public function viewAllUserDownload(Album $album) {
        $viewUsers = $album->purchased_albums()->get();
        return view('order_history.view_user_download', compact('album', 'viewUsers'));
    }
}
