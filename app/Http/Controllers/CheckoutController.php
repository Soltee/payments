<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use Omnipay\Omnipay;
class CheckoutController extends Controller
{
    public function index(Request $request)
    {
    	$type = $request->type;
    	// dd($type);
    	
    	return view('checkout', compact('type'));
    }

    public function store(Request $request)
    {
    	$method = $request->payment_method;
    	$type  = $request->type;


    	if($method == 'paypal'){
   			return redirect('/paypal/'. $type);
    	} 
    	elseif ($method == 'stripe') {
    	    if ($request->input('stripeToken')) {
  
                $gateway = Omnipay::create('Stripe');
                $gateway->setApiKey(env('STRIPE_SECRET_KEY'));
              
                $token = $request->input('stripeToken');
              
                $response = $gateway->purchase([
                    'amount' => $request->input('amount') ?? 10,
                    'currency' => 'usd',
                    'token' => $token,
                ])->send();
              
                if ($response->isSuccessful()) {
                    // payment was successful: insert transaction data into the database
                    $data = $response->getData();
                    // dd($data);
                    $order = Order::create([
                        'payment_method' => $method,
                            'payment_email' => 'hello@hello.com',
                            'payment_name'   => 'Hello',
                            'total'          => 10,
                            'status'        => 'completed',
                            'subscription'  => false
                        ]);
                    return redirect('/')->with('success', 'successful');
                // $isPaymentExist = Payment::where('payment_id', $arr_payment_data['id'])->first();
                
                } else {
                    return $response->getMessage();
                }
            }
                
                   
    	} 
        // elseif ($method == 'khalti') {
    		
    	// } else {
    	// 	return redirect('/checkout/intent');
    	// }
    }

 

    public function cancel()
    {
    	dd('Order has been canceled.');
    }
   
}
