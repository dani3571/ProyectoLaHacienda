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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->float('precioTotal', 10, 0);
            $table->integer('cantidadTotal');
            $table->date('fechaCompra');
            

            $table->unsignedBigInteger('id_proveedor'); 
            $table->foreign('id_proveedor')
            ->references('id')
            ->on('proveedores')
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
        Schema::dropIfExists('compras');
    }
};
