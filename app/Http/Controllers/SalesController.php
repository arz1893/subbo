<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SalesController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function showMonthlyRevenue(User $user) {
        $userWallet = $user->wallet()->first();
        $currency = $user->currency;
        return view('sales.show_monthly_sales', compact('user', 'userWallet', 'currency'));
    }

    public function withdrawDeposit(Request $request) {
        $user = User::findOrFail($request->user_id);
        $userWallet = $user->wallet;
        if($userWallet->deposit > 0) {
            $userWallet->deposit = $userWallet->deposit - $request->withdraw_amount;
            $userWallet->update();
            Session::flash('msg', 'you have been withdraw your account');
        } else {
            Session::flash('error', 'you don\'t have any deposit!');
        }
        return redirect()->back();
    }
}
