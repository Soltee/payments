<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class StripeController extends Controller
{
    public function create(Request $request){
        return $request->user()->createSetupIntent();
    }
}
