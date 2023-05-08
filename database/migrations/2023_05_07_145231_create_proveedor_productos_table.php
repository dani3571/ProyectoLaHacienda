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
        Schema::create('proveedor_productos', function (Blueprint $table) {
            $table->id();
            $table->date('fechaCompra')->nullable();
            $table->date('fechaVencimiento')->nullable();
          
           //foreingkeys            
           $table->unsignedBigInteger('id_producto'); 
            $table->foreign('id_producto')
            ->references('id')
            ->on('productos')
            ->onDelete('cascade');

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
        Schema::dropIfExists('proveedor_productos');
    }
};
