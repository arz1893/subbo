<?php

namespace App\Http\Controllers;

use App\Album;
use App\ImageThumbnail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function showPaymentPage(Album $album) {
        if(Auth::user()->id == $album->user_id) {
            return redirect()->route('showcase_album', $album->id);
        } else {
            $user = User::findOrFail($album->user_id);
            $userCurrency = $user->currency;
            $imageCover = ImageThumbnail::findOrFail($album->album_cover_id);
            return view('payment.payment_page', compact('imageCover', 'album', 'userCurrency'));
        }
    }

    public function buyAlbum(Request $request) {
        $album = Album::findOrFail($request->album_id);
        $albumAuthor = User::findOrFail($album->user_id);
        $authorWallet = $albumAuthor->wallet()->first();
        $authorWallet->deposit = $authorWallet->deposit + $album->price;
        $authorWallet->update();

        $album->purchased_albums()->sync(Auth::user()->id);
        Session::flash('message', 'Album has been purchased');
        return redirect()->route('showcase_album', $album);
    }

}
