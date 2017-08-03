<?php

namespace App\Http\Controllers;

use App\Album;
use App\ImageThumbnail;
use App\User;
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
    }

    public function showPaymentPage(Album $album) {
        if(Auth::user()->id == $album->user_id) {
            return redirect()->route('showcase_album', $album->id);
        } else {
            $user = User::findOrFail($album->user_id);
            $userCurrency = $user->currency;
            $imageCover = ImageThumbnail::findOrFail($album->album_cover_id);
            return view('payment.payment_page', compact('imageCover', 'album', 'userCurrency'));
        }
    }

    public function buyWithPaypal(Request $request) {

        $album = Album::findOrFail($request->album_id);
        $albumAuthor = User::findOrFail($album->user_id);
        $authorCurrency = $albumAuthor->currency;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();
        if($authorCurrency->code == 'IDR') {
            $item_1->setName($album->title) // item name
            ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($album->price * 0.000075); // unit price
        } else {
            $item_1->setName($album->title) // item name
            ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($album->price); // unit price
        }

        // add item to list
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($item_1->getPrice());

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Payment for ' . $album->title);

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('payment_status', $album)) // Specify return URL
        ->setCancelUrl(route('payment_status', $album));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->api_context);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            if (\Config::get('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Some error occur, sorry for inconvenient');
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        // add payment ID to session
        $request->session()->put('paypal_payment_id', $payment->getId());
//        \session(['album_id', $album->id]);

        if(isset($redirect_url)) {
            // redirect to paypal
            return redirect($redirect_url);
        }

        return redirect()->route('showcase_album', $album->id)->with('error', 'Unknown error occured');
    }

    public function getPaypalPaymentStatus(Request $request, Album $album) {
        // Get the payment ID before session clear
        $payment_id = $request->session()->pull('paypal_payment_id');
//        $album = Album::findOrFail($request->session()->pull('album_id'));
        $albumAuthor = User::findOrFail($album->user_id);


        if(empty($request->input('PayerID')) || empty($request->input('token'))){
            return redirect()->route('home')->with('info', 'Payment failed');
        }

        $payment = Payment::get($payment_id, $this->api_context);

        // PaymentExecution object includes information necessary
        // to execute a PayPal account payment.
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to your site
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));

        //Execute the payment
        $result = $payment->execute($execution, $this->api_context);

        if ($result->getState() == 'approved') { // payment made

//            dd($result);  // Use this data to work as you need

            $authorWallet = $albumAuthor->wallet()->first();
            $authorWallet->deposit = $authorWallet->deposit + $album->price;
            $authorWallet->update();
            $album->purchased_albums()->sync(Auth::user()->id);
            return redirect()->route('showcase_album', $album)->with('info', 'Album has been purchased');
        }
        return redirect()->route('showcase_album', $album)->with('error', 'Payment failed');
    }

}
