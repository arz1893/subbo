<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('etc.about');
});

Route::get('/contact', function () {
    return view('etc.contact');
});

//Route::get('/', 'RootController@index');
//Route::get('/about', 'HomeController@showAbout');
//Route::get('/contact', 'HomeController@showContact');
//Route::get('/showcatalog/{id}', 'RootController@showCatalog');
//Route::get('/showdownload/{id}', 'DownloadController@showDownloadPage');
//Route::get('/directdownload/{id}', 'DownloadController@directDownload');
//Route::get('/showpayment/{id}', 'PaymentController@showPaymentPage');
//Route::get('/searchalbum', 'SearchController@showSearchResult');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('/auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
//Route::get('/showhistory', 'WalletController@showOrderHistory');
//
Route::post('/album/getalbumname', 'AlbumController@getAlbumName');
Route::post('/image/getpicturename', 'ImageController@getPictureName');
Route::post('/image/setalbumcover', 'ImageController@setAlbumCover');
Route::post('/image/deleteimage', 'ImageController@deleteImage');
Route::post('/album/deletealbum', 'AlbumController@deleteAlbum');
Route::post('/album/publishalbum', 'AlbumController@publishAlbum');
Route::post('/album/unpublishalbum', 'AlbumController@unpublishAlbum');
//
Route::resource('user', 'UserController');
Route::resource('album', 'AlbumController');
Route::resource('image', 'ImageController');
//Route::resource('payment', 'PaymentController');
Route::resource('showcase', 'ShowcaseController');
Route::resource('sales', 'SalesController');
Route::get('/sales/show-monthly-revenue/{user}', 'SalesController@showMonthlyRevenue')->name('show_sales');
//
Route::post('/user/change-profile-picture', 'UserController@changeProfilePicture');
Route::get('/album/{album}/edit', 'AlbumController@edit')->name('album.edit')->middleware('ownership');
Route::get('/album/{album}', 'AlbumController@show')->name('album.show')->middleware('ownership');
Route::any('/create-blank-album', 'AlbumController@createAlbumFirst')->name('create_album_first');
Route::get('/album/create-album/{album}', 'AlbumController@create')->name('create_album');
Route::get('/album/choose-album-cover/{album}', 'AlbumController@chooseAlbumCoverPage')->name('choose_album_cover')->middleware('ownership');
Route::post('/album/apply-album-cover/{album}', 'AlbumController@applyAlbumCover')->name('apply_album_cover');
//Route::get('album/upload-image-page/{album}', 'AlbumController@uploadImagePage')->name('album.upload_image_page');
Route::post('/album/upload-image/', 'AlbumController@uploadAllImages')->name('album.upload_all_images');
Route::get('/showcase/show-album/{album}', 'ShowcaseController@showcaseAlbum')->name('showcase_album');

Route::get('/user/show-as-guest/{user}', 'UserController@showAsGuest')->name('show_as_guest');
Route::get('/bank-account', 'UserController@bankAccountPage')->name('bank_account');
Route::patch('/user/add-bank-account/{user}', 'UserController@addBankAccount')->name('add_bank_account');
Route::patch('/user/update-currency/{user}', 'UserController@updateCurrency')->name('update_currency');
Route::get('/user/account-setting-page/{user}', 'UserController@accountSettingPage')->name('account_setting');
Route::post('/user/change-password/{user}', 'UserController@changePassword')->name('change_password');

Route::get('/payment/{album}', 'PaymentController@showPaymentPage')->name('show_payment');
Route::post('/payment/buy-album', 'PaymentController@buyAlbum')->name('buy_album');

Route::get('/order_history/{user}', 'OrderHistoryController@showOrderHistory')->name('order_history');

Route::get('/download/{album}', 'DownloadController@showDownload')->name('show_download');
Route::post('/download/download-album', 'DownloadController@downloadAlbum')->name('download_album');