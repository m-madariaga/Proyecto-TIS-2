<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataBankTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_bank_transfers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('run');
            $table->string('email');
            $table->string('bank');
            $table->string('account_type');
            $table->unsignedBigInteger('account_number');
            $table->boolean('selected');
            $table->unsignedBigInteger('paymentmethod_fk');
            $table->foreign('paymentmethod_fk')->references('id')->on('payment_methods');
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
        Schema::dropIfExists('data_bank_transfers');
    }
}
