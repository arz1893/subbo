<?php

namespace App\Http\Controllers;

use App\WithdrawRequest;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function getAllWithdrawRequest(Request $request) {
        $withdrawLists = array();
        $withdrawRequests = WithdrawRequest::all();
//        foreach ($withdrawRequests as $withdrawRequest) {
//            $user = $withdrawRequest->user;
//            $withdrawList = array(
//                'id' => $withdrawRequest->id,
//                'amount' => $withdrawRequest->amount,
//                'date' => $withdrawRequest->created_at->format('d-M-Y'),
//                'is_approved' => $withdrawRequest->is_approved,
//                'user_id' => $user->id,
//                'name' => $user->name,
//                'email' => $user->email
//            );
//            array_push($withdrawLists, $withdrawList);
//        }
//
        return response()->json([
            'withdraw_lists' => $withdrawRequests
        ], 200);
    }
}
