<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebpayCredentialsTable extends Migration
{
    public function up()
    {
        Schema::create('webpay_credentials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('commerce_code');
            $table->text('api_key');
            $table->string('integration_type');
            $table->string('environment');
            $table->unsignedBigInteger('paymentmethod_fk'); 
            $table->foreign('paymentmethod_fk')->references('id')->on('payment_methods');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('webpay_credentials');
    }
}
