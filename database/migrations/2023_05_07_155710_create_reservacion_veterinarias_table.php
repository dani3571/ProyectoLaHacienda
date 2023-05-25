<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservacion_veterinarias', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('horaRecepcion', 60);
            $table->string('motivoReservacion', 200);


            //Foreign keys
            $table->unsignedBigInteger('usuario_id'); 
            $table->foreign('usuario_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

               //Foreign keys
               $table->unsignedBigInteger('mascota_id'); 
               $table->foreign('mascota_id')
               ->references('id')
               ->on('mascotas')
               ->onDelete('cascade');

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
        Schema::dropIfExists('reservacion_veterinarias');
    }
};
