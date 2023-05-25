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
        Schema::create('habitacions', function (Blueprint $table) {
            $table->id();
            $table->integer('nro_habitacion');
            $table->decimal('costo_habitacion');
            $table->integer('capacidad');

         //revisar
            $table->unsignedBigInteger('reservacionHotel_id')->nullable(); 
            $table->foreign('reservacionHotel_id')
            ->references('id')
            ->on('reservacion_hotels')
            ->onDelete('set null');
 
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
        Schema::dropIfExists('habitacions');
    }
};
