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
        Schema::create('usuario_reservacion_peluquerias', function (Blueprint $table) {
            $table->id();
           //Foreign keys
           $table->unsignedBigInteger('usuario_id'); 
           $table->foreign('usuario_id')
           ->references('id')
           ->on('users')
           ->onDelete('cascade');
       
           $table->unsignedBigInteger('reservacionPeluqueria_id'); 
           $table->foreign('reservacionPeluqueria_id')
           ->references('id')
           ->on('reservacion_peluquerias')
           ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_reservacion_peluquerias');
    }
};
