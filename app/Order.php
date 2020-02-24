<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    	'payment_id', 'payment_method', 'payment_email', 'payment_name', 'total', 'currency', 'discount', 'status', 'subscription'
    ];
}
