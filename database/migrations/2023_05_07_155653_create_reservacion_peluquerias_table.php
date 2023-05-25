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
        Schema::create('reservacion_peluquerias', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('horaRecepcion', 60);
            $table->string('horaEntrega', 60);
            $table->char('BanoSimple', 1)->default(0);
            //completar atributos
            $table->char('corte', 1);
            $table->char('tranquilizante', 1)->default(0);
            $table->string('Observaciones', 200);
            $table->char('estado', 1)->default(1);
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
        Schema::dropIfExists('reservacion_peluquerias');
    }
};
