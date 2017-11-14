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
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect()->intended('/home');
    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }

        $user =  User::create([
            'id' => Uuid::generate(3, $user->email, Uuid::NS_DNS),
            'name'     => $user->name,
            'email'    => $user->email,
            'provider_name' => $provider,
            'provider_id' => $user->id,
        ]);

        $userWallet = Wallet::create([
            'user_id' => $user->id
        ]);

        $user->wallet_id = $userWallet->id;
        $user->update();

        return $user;
    }
}
