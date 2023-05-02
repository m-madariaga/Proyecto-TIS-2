<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {           
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('marca_id');
            $table->foreign('marca_id')->references('id')->on('marca_productos');
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->string('nombre');
            $table->integer('precio');
            $table->string('color');
            $table->string('talla');
            $table->integer('stock');
            $table->string('imagen');
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
        Schema::dropIfExists('productos');
    }
    public function after()
    {    
        $this->after('create_categorias_table');
        $this->after('create_marca_productos_table');       
    }
}
