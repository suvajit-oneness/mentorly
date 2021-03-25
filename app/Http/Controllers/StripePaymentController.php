<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;use Session;use App\Models\StripeTransaction;
use App\Models\Mentor;use Auth;

class StripePaymentController extends Controller
{
    public function bookingSlotstripe(Request $req)
    {
        $req->validate([
            'slotId' => 'required',
            'userType' => 'required',
            'mentorId' => 'required',
        ]);
        $mentor = Mentor::findOrFail(base64_decode($req->mentorId));
        $data = $req->all();
        return view('stripe.index',compact('data','mentor'));
    }

    public function bookingStripePost(Request $req)
    {
        $req->validate([
            '_token' => 'required',
            'stripeToken' => 'required',
            'slotId' => 'required|min:1|numeric',
            'userType' => 'required|in:mentor,web',
            'amount' => 'required',
        ]);
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $payment = \Stripe\Charge::create ([
            "amount" => $req->amount,
            "currency" => "usd",
            "source" => $req->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);
        if($payment->status == 'succeeded'){
            $user = Auth::guard($req->userType)->user();
        	$stripe = new StripeTransaction;
        	$stripe->transactionId = $payment->id;
        	$stripe->balance_transaction = $payment->balance_transaction;
        	$stripe->amount = $payment->amount;
        	$stripe->description = $payment->description;
        	$stripe->payment_method = $payment->payment_method;
        	$stripe->card_type = $payment->payment_method_details->type;
        	$stripe->exp_month = $payment->payment_method_details->card->exp_month;
        	$stripe->exp_year = $payment->payment_method_details->card->exp_year;
        	$stripe->last4 = $payment->payment_method_details->card->last4;
        	$stripe->save();
            return redirect(route('stripe.payment.success').'?slotId='.$req->slotId.'&userType='.$req->userType.'&transactionId='.$stripe->id);
        	// return redirect(route('stripe.success',base64_encode($stripe->id)));
        }
        return back();
    }

    public function successTransaction(Request $req, $transactionId)
    {
    	$stripe = StripeTransaction::findOrfail(base64_decode($transactionId));
    	return view('stripe.thankyou',compact('stripe'));
    }
}
