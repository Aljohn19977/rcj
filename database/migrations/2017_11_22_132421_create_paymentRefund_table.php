<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentRefundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paymentRefund', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_id');
            $table->string('payment_id');
            $table->string('user_id');
            // $table->string('name');
            // $table->string('contact');
            // $table->string('landline');
            // $table->string('address1');
            // $table->string('address2');
            // $table->string('region');
            // $table->string('city');
            // $table->string('barangay');
            // $table->string('landmark');
            // $table->string('message');
            $table->string('product_name');
            $table->string('product_id');
            $table->integer('qty');
            $table->string('sub_total');
            $table->integer('payment');
            $table->integer('status');
            $table->integer('refund_status');
            $table->softDeletes();
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
         Schema::dropIfExists('paymentRefund');
    }
}
