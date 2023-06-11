<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
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
            $table->string('horaRecepcion', 60)->nullable();
            $table->char('tratamiento_veterinaria',1)->default(0);
            $table->char('tratamiento_corte_banio',1)->default(0);
            $table->string('observaciones', 200);
            $table->string('zona_direccion', 200)->nullable();
            $table->string('direccion', 200)->nullable();
            $table->decimal('costo_transporte', 8)->default(0);
            $table->decimal('costo_comida', 8)->default(0);
            $table->decimal('costo_veterinaria', 8)->default(0);
            $table->decimal('costo_corte_banio', 8)->default(0);
            $table->decimal('costo_extras', 8)->default(0);
            $table->decimal('costo_total', 8);
            $table->string('horaCheckin', 60)->nullable();
            $table->string('horaCheckout', 60)->nullable();
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

                 //habitaciones
            $table->unsignedBigInteger('habitacion_id');
            $table->foreign('habitacion_id')
                ->references('id')
                ->on('habitacions')
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
        Schema::dropIfExists('reservacion_hotels');
    }
};