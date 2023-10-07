<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsPetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments_pet', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pet');
            $table->date('vaccination_date');
            $table->unsignedBigInteger('id_medicine');
            $table->unsignedBigInteger('id_user');
            $table->date('next_vaccination_date');
            // Definimos las claves foráneas
            $table->foreign('id_pet')->references('id')->on('pets');
            $table->foreign('id_medicine')->references('id')->on('medicines');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments_pet');
    }
}
