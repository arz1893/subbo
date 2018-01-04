<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Wallet;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Webpatser\Uuid\Uuid;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = \url()->previous();
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($provider) {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider) {
        $user = Socialite::driver($provider)->user();
        dd($user);
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect()->intended('/home');
    }

    public function findOrCreateUser($user, $provider)
    {
        dd($user, $provider);
        if($provider == 'facebook') {
            $authUser = User::where('facebook_id', $user->id)->first();
            if(!is_null($authUser)) {
                return $authUser;
            } else {
                $user =  User::create([
                    'id' => Uuid::generate(3, $user->email, Uuid::NS_DNS),
                    'name'     => $user->name,
                    'email'    => $user->email,
                    'provider_name' => $provider,
                    'facebook_id' => $user->id,
                ]);

                $userWallet = Wallet::create([
                    'user_id' => $user->id
                ]);

                $user->wallet_id = $userWallet->id;
                $user->update();

                return $user;
            }
        } else if($provider == 'twitter') {
            $authUser = User::where('twitter_id', $user->id)->first();
            if(!is_null($authUser)) {
                return $authUser;
            } else {
                $user =  User::create([
                    'id' => Uuid::generate(3, $user->email, Uuid::NS_DNS),
                    'name'     => $user->name,
                    'email'    => $user->email,
                    'provider_name' => $provider,
                    'twitter_id' => $user->id,
                ]);

                $userWallet = Wallet::create([
                    'user_id' => $user->id
                ]);

                $user->wallet_id = $userWallet->id;
                $user->update();

                return $user;
            }

        } else if($provider == 'google') {
            $authUser = User::where('google_id', $user->id)->first();
            if(!is_null($authUser)) {
                return $authUser;
            } else {
                $user =  User::create([
                    'id' => Uuid::generate(3, $user->email, Uuid::NS_DNS),
                    'name'     => $user->name,
                    'email'    => $user->email,
                    'provider_name' => $provider,
                    'google_id' => $user->id,
                ]);

                $userWallet = Wallet::create([
                    'user_id' => $user->id
                ]);

                $user->wallet_id = $userWallet->id;
                $user->update();

                return $user;
            }
        } else {
            return redirect()->route('login')->with('error', 'Whoops there is something wrong!');
        }
    }
}
