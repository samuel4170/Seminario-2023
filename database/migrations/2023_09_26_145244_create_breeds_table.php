<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBreedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breeds', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();//No se deben repetir el registr de razas en el sistema
            $table->unsignedBigInteger('id_specie'); //Se crea el campo para la llave foranea en la tabla
            $table->foreign('id_specie')->references('id')->on('species'); //Se especifica a que atributo y de que tabla hace referencia
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('breeds');
    }
}
