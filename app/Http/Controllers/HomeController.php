<?php

namespace App\Http\Controllers;

use App\Currency;
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
    public function index(Request $request)
    {
        $country_name = $request->session()->pull('country_name');
        $currentUser = Auth::user();

        if($country_name != null || Auth::user()->wallet_id == null) {
            if($currentUser->currency_id == null) {
                $currency = Currency::where('country', $country_name)->first();

                if($currency != null) {
                    $currentUser->currency_id = $currency->id;
                } else {
                    $currentUser->currency_id = 2;
                }
            }

            if(Auth::user()->wallet_id == null) {
                $wallet = Wallet::create([
                    'user_id' => Auth::user()->id
                ]);
                $currentUser->wallet_id = $wallet->id;
            }

            $currentUser->update();
        }

        return view('home');
    }

    public function showAbout(Request $request) {
        dd($request->session()->all());
        return view('etc.about');
    }

    public function showContact() {
        return view('etc.contact');
    }
}
