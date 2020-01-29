<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');

            $table->dateTime('start_date');
            $table->dateTime('expiry_date')->nullable();
            $table->float('amount');
            $table->string('payment_mode');
            $table->integer('mpesa_id')->nullable();
            $table->integer('paypal_id')->nullable();
            $table->integer('user_id');
            $table->integer('plan_id');
            // $table->foreign('mpesa_id')->references('id')->on('mpesas');

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
        Schema::dropIfExists('subscriptions');
    }
}
