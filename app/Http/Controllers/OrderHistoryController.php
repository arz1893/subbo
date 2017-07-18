<?php

namespace App\Http\Controllers;

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
        return view('order_history.show_order_history', compact('user', 'purchasedAlbums'));
    }
}
