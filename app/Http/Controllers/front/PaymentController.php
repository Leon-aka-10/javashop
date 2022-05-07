<?php

namespace App\Http\Controllers\front;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Paystack;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Payment;

class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }        
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        // dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want

        $payment = new Payment();

        $payment->email = $paymentDetails['data']['customer']['email'];
        $payment->status = $paymentDetails['data']['status'];
        $payment->amount = $paymentDetails['data']['amount'];
        $payment->trans_id = $paymentDetails['data']['id'];
        $payment->ref_id = $paymentDetails['data']['reference'];
        $payment->save();
        
         
        //redirect
        return redirect()->back()->with('msg','Successful Transaction');
    }
}
