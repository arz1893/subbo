<?php

namespace App\Http\Controllers;

use App\User;
use App\Wallet;
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
        if($user->wallet_id == null) {
            $wallet = Wallet::create([
                'user_id' => $user->id,
                'deposit' => 0,
                'withdraw' => 0
            ]);
            $user->wallet_id = $wallet->id;
            $user->update();
        }

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
                $userWallet->deposit = $userWallet->deposit - $request->withdraw_amount;
                $userWallet->save();
                Session::flash('msg', 'your money has been transferred to your account');
//                WithdrawRequest::create([
//                    'amount' => $request->withdraw_amount,
//                    'user_id' => Auth::user()->id,
//                ]);
//                Session::flash('msg', 'your withdraw request has been processed');
            }
        } else {
            Session::flash('error', 'you don\'t have any deposit!');
        }
        return redirect()->back();
    }
}
