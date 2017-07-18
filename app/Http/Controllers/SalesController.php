<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function showMonthlyRevenue(User $user) {
        $userWallet = $user->wallet()->first();
        return view('sales.show_monthly_sales', compact('user', 'userWallet'));
    }
}
