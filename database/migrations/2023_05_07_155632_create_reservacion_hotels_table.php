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
        Schema::create('reservacion_hotels', function (Blueprint $table) {
            $table->id();
            $table->date('fechaIngreso');
            $table->date('fechaSalida');
            $table->string('tratamientos', 200);
            $table->decimal('tranporte', 8);
            $table->decimal('comida', 8);
            $table->decimal('banioYCorte', 8);
            $table->decimal('tratamiento', 8);
            $table->decimal('extras', 8);
            $table->decimal('total', 8);
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservacion_hotels');
    }
};
