<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class WelcomeController extends Controller
{
    public function index(){

    	$orders = Order::latest()->paginate(10);
    	$once = Order::latest()->where('subscription', false)->paginate(10);
    	$subscriptions = Order::latest()->where('subscription', true)->paginate(10);
    	// Order::query()->truncate();
    	// dd(count($subscriptions));
    	return view('welcome', compact('subscriptions', 'once', 'orders'));
    }

    public function auth(){
        return $request->user()->createSetupIntent();
    }
}
