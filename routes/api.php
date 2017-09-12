<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/admin_user', [
    'uses' => 'AdminUserController@signUp'
]);

Route::post('/admin_user/signin', [
    'uses' => 'AdminUserController@signIn'
]);

Route::post('/admin_user/signout', [
    'uses' => 'AdminUserController@signOut'
]);

Route::get('/admin_user/{id}', [
    'uses' => 'AdminUserController@getAdminUser'
]);