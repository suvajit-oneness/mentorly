<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;use Session;

class StripePaymentController extends Controller
{
    public function stripe(Request $req,$price=300)
    {
        return view('stripe.index',compact('price'));
    }

    public function stripePost(Request $req)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        \Stripe\Charge::create ([
            "amount" => 100 * $req->amount,
            "currency" => "usd",
            "source" => $req->stripeToken,
            "description" => "Test payment from itsolutionstuff.com." 
        ]);
        Session::flash('success', 'Payment successful!');
        return back();
    }
}
