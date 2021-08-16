<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;use Session;use App\Models\StripeTransaction;
use App\Models\Mentor;use Auth,App\Models\AvailableShift;

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
        // \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        \Stripe\Stripe::setApiKey('sk_test_4eC39HqLyjWDarjtT1zdp7dc');
        $payment = \Stripe\Charge::create ([
            "amount" => 100 * $req->amount,
            "currency" => "usd",
            "source" => $req->stripeToken,
            "description" => "Mentorly Payment for Booking Slot"
        ]);
        if($payment->status == 'succeeded'){
            $user = Auth::guard($req->userType)->user();
            $slot = AvailableShift::where('id',$req->slotId)->first();
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
            
            $dataMentee = [
                'name' => $user->name,
                'amount' => ($req->amount/100),
                'todayDate' => date('M-d-y'),
                'transactionId' => $stripe->transactionId,
                'content' => 'We have received your payment $'.$req->amount.' for the mentorly session dated '.date('M d,Y',strtotime($slot->date)).' at '.date('H:i:s',strtotime($slot->time_shift)).'.',
            ];
            sendMail($dataMentee,'email/invoicetemplate',$user->email,'Payment Successful for Mentorly Session !!');
            return redirect(route('stripe.payment.success').'?slotId='.$req->slotId.'&userType='.$req->userType.'&transactionId='.$stripe->id);
        }
        return back();
    }

    public function thankyouPageToSHow(Request $req)
    {
        $req->validate([
            'transactionId' => 'required|min:1|numeric',
        ]);
    	$stripe = StripeTransaction::findOrfail($req->transactionId);
    	return view('stripe.thankyou',compact('stripe'));
    }



    public function invoiceshow()
    {
        $dataMentee = [
                'name' => 'souvik',
                'amount' => '5000',
                'todayDate' => '07-30-2021',
                'transactionId' => '123456',
                'content' => 'test content',
            ];

        return view('email/invoicetemplate',compact('dataMentee'));

    }





}
