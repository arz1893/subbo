<?php

namespace App\Http\Controllers;

use App\Album;
use App\Exceptions\VeritransException;
use App\ImageThumbnail;
use App\PaypalInvoice;
use App\User;
use App\Veritrans\Midtrans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;



class PaymentController extends Controller
{
    private $api_context;

    function __construct()
    {
        $this->middleware('auth');
        $paypal_conf = Config::get('paypal');
        $this->api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->api_context->setConfig($paypal_conf['settings']);
        Midtrans::$serverKey = 'VT-server-G23aydjGxOjQj_4TMg0XDx2d';
        Midtrans::$isProduction = false;
    }

    public function showPaymentPage(Album $album) {
        if(Auth::user()->id == $album->user_id) {
            return redirect()->route('guest_showcase', $album->id);
        } else {
            foreach (Auth::user()->purchased_albums as $purchased_album) {
                if($purchased_album->id == $album->id) {
                    return \redirect()->route('showcase_album', $album->id);
                }
            }

            $user = User::findOrFail($album->user_id);
            $userCurrency = $user->currency;
            $imageCover = ImageThumbnail::findOrFail($album->album_cover_id);
            $convertedPrice = number_format(currency($album->price, $userCurrency->code, 'USD', false), 2, '.', ',');
            return view('payment.payment_page', compact('imageCover', 'album', 'userCurrency', 'convertedPrice'));
        }
    }

    public function createInvoice(Request $request) {

        $paypalInvoice = PaypalInvoice::create([
            'album_id' => $request->album_id,
            'user_id' => Auth::user()->id,
            'payer_id' => $request->payer_id,
            'payment_id' => $request->payment_id,
            'payment_token' => $request->payment_token
        ]);

        $album = Album::findOrFail($request->album_id);
        $albumAuthor = User::findOrFail($album->user_id);
        $authorWallet = $albumAuthor->wallet()->first();
        $authorWallet->deposit = $authorWallet->deposit + $album->price;
        $authorWallet->update();

        $album->purchased_albums()->sync(Auth::user()->id);
        return redirect()->route('showcase_album', $album)->with('info', 'Album has been purchased');
    }
}
