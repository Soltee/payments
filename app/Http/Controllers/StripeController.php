<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class StripeController extends Controller
{
    public function create(Request $request){
        return response()->json(['intent' => auth()->user()->createSetupIntent()], 200);
    }

    public function store(Request $request)
    {
	    $user = auth()->user();
	    $paymentMethodID = $request->input('method');

	    if( $user->stripe_id == null ){
	        $user->createAsStripeCustomer();
	    }

	    $user->addPaymentMethod( $paymentMethodID );
	    $user->updateDefaultPaymentMethod( $paymentMethodID );
	    
	    return response()->json( null, 204 );        

    },
    public function getPaymentMethods( Request $request ){
	    $user = auth()->user();

	    $methods = [];

	    if( $user->hasPaymentMethod() ){
	        foreach( $user->paymentMethods() as $method ){
	            array_push( $methods, [
	                'id' => $method->id,
	                'brand' => $method->card->brand,
	                'last_four' => $method->card->last4,
	                'exp_month' => $method->card->exp_month,
	                'exp_year' => $method->card->exp_year,
	            ] );
	        }
	    }

	    return response()->json( $methods );
	}

}
