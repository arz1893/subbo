<?php

namespace App\Http\Controllers;

use App\AdminUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
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
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        try {
            Config::set('auth.providers.users.model', \App\AdminUser::class);
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

    public function getAdminUser(Request $request, $id) {
        $user = AdminUser::findOrFail($id);
        return response()->json($user, 200);
    }
}
