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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 30)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('direccion', 60)->nullable();
            $table->string('ciudad', 60)->nullable();
            $table->string('url', 60)->nullable();
            $table->date('fecha_registro')->default(now());
            $table->char('Estado')->default(1);
            $table->timestamps();
            
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->foreign('usuario_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedores');
    }
};
