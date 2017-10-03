<?php

namespace App\Http\Controllers;

use App\User;
use App\WithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            if($request->withdraw_amount > $userWallet->deposit) {
                Session::flash('error', 'you don\'t have enough money');
            } else {
                WithdrawRequest::create([
                    'amount' => $request->withdraw_amount,
                    'user_id' => Auth::user()->id,
                ]);
                Session::flash('msg', 'your withdraw request has been processed');
            }
        } else {
            Session::flash('error', 'you don\'t have any deposit!');
        }
        return redirect()->back();
    }
}
