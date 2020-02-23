<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('payment_id');
            $table->enum('payment_method', ['cash_on_delivery', 'paypal','stripe','card'])->default('cash_on_delivery');            
            $table->string('payment_email');
            $table->string('payment_name');
            $table->float('discount');
            $table->float('total');
            $table->enum('currency', ['usd', 'rs','eu'])->default('usd');            
            $table->enum('status', ['pending','processing','completed','decline'])->default('pending');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
