<?php

namespace App\Http\Controllers;

use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->wallet_id == null) {
            $currentUser = Auth::user();
            $wallet = Wallet::create([
                'user_id' => Auth::user()->id
            ]);
            $currentUser->wallet_id = $wallet->id;
            $currentUser->update();
        }
        return view('home');
    }

    public function showAbout() {
        return view('etc.about');
    }

    public function showContact() {
        return view('etc.contact');
    }
}
