<?php

namespace App\Http\Controllers;

use App\Album;
use App\Currency;
use App\Http\Requests\BankAccountRequest;
use App\Http\Requests\UserRequest;
use App\ImageThumbnail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Torann\GeoIP\Facades\GeoIP;

class UserController extends Controller
{
    public function showAsGuest(Request $request, User $user) {
        $latestNullAlbums = Album::where('title', null)->where('user_id', $user->id)->get();
        if($latestNullAlbums != null) {
            foreach ($latestNullAlbums as $latestNullAlbum) {
                if(file_exists(public_path('uploaded_images/' . $user->email . '/' . $latestNullAlbum->id))) {
                    File::deleteDirectory(public_path('uploaded_images/' . $user->email . '/' . $latestNullAlbum->id));
                }
                if(file_exists(public_path('image_thumbnails/' . $user->email . '/' . $latestNullAlbum->id))) {
                    File::deleteDirectory(public_path('image_thumbnails/' . $user->email . '/' . $latestNullAlbum->id));
                }
                $latestNullAlbum->delete();
            }
        }

        $albums = DB::table('albums')->where('user_id', $user->id)->where('is_published', 1)->paginate(6);
        $imageThumbnails = ImageThumbnail::all();
        $host = $request->getHttpHost();
        return view('user.show_as_guest', compact('user', 'albums', 'imageThumbnails', 'host'));
    }

    public function show(User $user) {
        $currencies = Currency::all();
        $select_currency = Currency::pluck('code', 'id');
        return view('user.show_user', compact('user','currencies', 'select_currency'));
    }

    public function edit(User $user) {
        return view('user.edit_user', compact('user'));
    }

    public function update(UserRequest $request, User $user) {
        $user->update($request->all());
        return redirect()->route('user.show', $user->id);
    }

    public function bankAccountPage() {
        return view('user.add_bank_account');
    }

    public function addBankAccount(BankAccountRequest $request, User $user) {
        $user->update($request->all());
        return redirect()->back();
    }

    public function updateCurrency(Request $request, User $user) {
        $userWallet = $user->wallet;
        if($userWallet->deposit > 0) {
            Session::flash('error', 'please make sure your account deposit is empty');
        }
        else if($request->currency_id != null) {

            if($request->currency_id != $user->currency_id) {
                $user->update($request->all());
                $userAlbums = $user->albums;
                foreach ($userAlbums as $userAlbum) {
                    $userAlbum->is_published = 0;
                    $userAlbum->update();
                }
            }
        }
        return redirect()->back();
    }

    public function changeProfilePicture(Request $request) {
        $this->validate($request, [
            'profile_picture' => 'required|image|'
        ]);
        $user = User::findOrFail($request->user_id);
        if($user->avatar != null) {
            unlink(public_path('/profile_picture/' . $user->avatar));
            $image = $request->file('profile_picture');
            $image->move(public_path('profile_picture/'),  $user->email . '_' . $image->getClientOriginalName());
            $user->avatar = $user->email . '_' . $image->getClientOriginalName();
            $user->update();
        } else {
            $image = $request->file('profile_picture');
            $image->move(public_path('profile_picture/'),  $user->email . '_' . $image->getClientOriginalName());
            $user->avatar = $user->email . '_' . $image->getClientOriginalName();
            $user->update();
        }

        return redirect()->back();
    }

    public function accountSettingPage(Request $request, User $user) {
        $currencies = Currency::all();
        $select_currency = Currency::pluck('country', 'id');
        return view('user.account_setting', compact('user', 'currencies', 'select_currency'));
    }

    public function changePassword(Request $request, User $user) {
        if(Auth::check()) {
            if($user->password == null) {
                $user->password = Hash::make($request->password);
                $user->update();
                Session::flash('success', 'Your password has been added');
                return redirect()->back();
            } else {
                $current_password = $user->password;
                if(Hash::check($request->current_password, $current_password)) {
                    $user->password = Hash::make($request->password);
                    $user->update();
                    Session::flash('success', 'Your password has been changed');
                    return redirect()->back();
                } else {
                    Session::flash('error', 'Your current password didn\'t match');
                    return redirect()->back();
                }
            }
        }

        return redirect('/');
    }

    public function changePhoneNumber(Request $request, User $user) {
        $user->phone_number = $request->phone_number;
        $user->update();
        return redirect()->back();
    }
}
