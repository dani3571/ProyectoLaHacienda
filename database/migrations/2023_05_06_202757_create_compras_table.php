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
            $table->integer('cantidad');
            $table->date('fechaCompra');
            $table->timestamps();


            $table->unsignedBigInteger('id_proveedor'); 
            $table->foreign('id_proveedor')
            ->references('id')
            ->on('proveedores')
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
        Schema::dropIfExists('compras');
    }
};
