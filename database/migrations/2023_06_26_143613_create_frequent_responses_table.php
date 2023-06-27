<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrequentResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frequent_responses', function (Blueprint $table) {
            $table->id();
            $table->string('respuesta');
            $table->unsignedBigInteger('frequent_question_id');
            $table->timestamps();

            $table->foreign('frequent_question_id')->references('id')->on('frequent_questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('frequent_responses');
    }
}
