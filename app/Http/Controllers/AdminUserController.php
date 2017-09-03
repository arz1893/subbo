<?php

namespace App\Http\Controllers;

use App\AdminUser;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Webpatser\Uuid\Uuid;

class AdminUserController extends Controller
{
    public function signUp(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admin_users',
            'password' => 'required|min:4'
        ]);

        $admin_user = new AdminUser([
            'id' => Uuid::generate(3, $request->input('email'), Uuid::NS_DNS),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        $admin_user->save();

        return response()->json([
            'message' => 'successfully created user',
        ], 201);
    }

    public function signIn(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        try {
            if(!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'error' => 'Invalid Credentials!'
                ], 401);
            }
        } catch (JWTException $exception) {
            return response()->json([
                'error' => 'Could not create token!'
            ], 500);
        }
        return response()->json([
            'token' => $token
        ], 200);
    }
}
