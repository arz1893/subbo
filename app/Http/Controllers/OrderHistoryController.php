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

    public function showOrderHistory(User $user) {
        $purchasedAlbums = $user->purchased_albums()->get();
        $currency = $user->currency;
        return view('order_history.show_order_history', compact('user', 'purchasedAlbums', 'currency'));
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
