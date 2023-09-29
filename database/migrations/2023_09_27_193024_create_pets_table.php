<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('owner_name')->nullable(false);
            $table->string('owner_phone')->nullable(false);
            $table->string('owner_email')->nullable(true); //el email es opcional
            $table->string('pet_name')->nullable(false);
            $table->unsignedBigInteger('id_specie');
            $table->unsignedBigInteger('id_breed');
            $table->boolean('pet_sex'); //1 = macho, 0 = hembra.
            $table->unsignedBigInteger('id_color');
            $table->date('birthdate');
            $table->string('add_info');
            $table->boolean('status'); // 1 = activo, 0 = inactivo
            // Definimos las claves foráneas
            $table->foreign('id_specie')->references('id')->on('species');
            $table->foreign('id_breed')->references('id')->on('breeds');
            $table->foreign('id_color')->references('id')->on('colors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pets');
    }
}
