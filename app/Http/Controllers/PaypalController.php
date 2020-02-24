<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Order;
use Carbon\Carbon;

class PaypalController extends Controller
{
	public function index($type)
	{
        $checkoutData = $this->checkoutData($type);
		$provider = new ExpressCheckout();
		// dd($checkoutData);
		if($type == 'subscription'){
			$response = $provider->setExpressCheckout($checkoutData, true);
		} else {
			$response = $provider->setExpressCheckout($checkoutData);
		}
    	// dd($response);
    	// if($response['type'] == 'error'){
    	// 	dd('Error');
    	// }
    	return redirect($response['paypal_link']);


	}

    public function store(Request $request, $type)
    {
    	// dd()
    	$token = $request->get('token');
        $payerId = $request->get('PayerID');
        $provider = new ExpressCheckout();
        $checkoutData = $this->checkoutData($type);

        $response = $provider->getExpressCheckoutDetails($token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {

            if($type == 'subscription'){

	        	$startdate = Carbon::now()->toAtomString();
				$profile_desc = 'Monthly subscription';
				// $profile_desc = !empty($data['subscription_desc']) ?
				//             $data['subscription_desc'] : $data['invoice_description'];
				$data = [
				    'PROFILESTARTDATE' => $startdate,
				    'DESC' => $profile_desc,
				    'BILLINGPERIOD' => 'Month', // Can be 'Day', 'Week', 'SemiMonth', 'Month', 'Year'
				    'BILLINGFREQUENCY' => 1, // 
				    'AMT' => 10, // Billing amount for each billing cycle
				    'CURRENCYCODE' => 'USD', // Currency code 
				    'TRIALBILLINGPERIOD' => 'Day',  // (Optional) Can be 'Day', 'Week', 'SemiMonth', 'Month', 'Year'
				    'TRIALBILLINGFREQUENCY' => 10, // (Optional) set 12 for monthly, 52 for yearly 
				    'TRIALTOTALBILLINGCYCLES' => 1, // (Optional) Change it accordingly
				    'TRIALAMT' => 0, // (Optional) Change it accordingly
				];
				// $response = $provider->createRecurringPaymentsProfile($checkoutData, $token);

				$amount = 9.99;

				$description = "Monthly Subscription #1";
				$response = $provider->createMonthlySubscription($token, $amount, $description);

				$order = Order::create([
				    		'payment_email' => 'hello@hello.com',
				    		'payment_name'   => 'Hello',
				    		'total'          => $amount,
				    		'status'        => 'completed',
				    		'subscription'  => 1
				    	]);


			} else {

			            // Perform transaction on PayPal
	            $payment_status = $provider->doExpressCheckoutPayment($checkoutData, $token, $payerId);
	            $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];

	            if(in_array($status, ['Completed','Processed'])) {
				    	$order = Order::create([
				    		'payment_email' => 'hello@hello.com',
				    		'payment_name'   => 'Hello',
				    		'total'          => 14,
				    		'status'        => 'completed',
				    		'subscription'  => false
				    	]);

	            }
	        }
	        // Mail::to($order->user->email)->send(new OrderPaid($order));

	        return redirect('/')->withMessage('Payment successful!');

        }

        return redirect('/')->withError('Payment UnSuccessful! Something went wrong!');
    }

    public function checkoutData($type)
    {		
    	if($type == 'subscription'){

    		$data = [
	    			[
		    			'name' => 'Intermediate',
		    			'price' => 9,
		    			'qty'   => 1
		    		]
		    		
		    		
		    	];

		    return [
	    		'items' => $data,
	            'return_url' => route('paypal.success', $type),	    	
	            'cancel_url' => route('checkout.cancel'),
		    	'invoice_id'   => uniqid(),
		    	'invoice_description' => 'Monthly Subscription for Intermediate',
		    	'subscription_desc' => 'Monthly Subscription for Intermediate',
		    	'total'    => 9
	    	];
    	

		} else {

    		$data = [
	    			[
		    			'name' => 'Product 1',
		    			'price' => 9,
		    			'qty'   => 1
		    		],
		    		[
		    			'name' => 'Product 2',
		    			'price' => 5,
		    			'qty'   => 1
		    		]
		    		
		    	];

		    return [
	    		'items' => $data,
	            'return_url' => route('paypal.success', $type),	    	
	            'cancel_url' => route('checkout.cancel'),
		    	'invoice_id'   => uniqid(),
		    	'invoice_description' => 'Purchase an Order',
		    	'total'    => 14
	    	];
    	
		}
    	
    }
}
