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
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id();
            $table->date('fechaCompra')->nullable();
            $table->date('fechaVencimiento')->nullable();
            
            $table->unsignedBigInteger('id_venta'); 
            $table->foreign('id_venta')
            ->references('id')
            ->on('ventas')
            ->onDelete('cascade');
        
      
           /*
            $table->unsignedBigInteger('id_producto'); 
            $table->foreign('id_producto')
            ->references('id')
            ->on('producto')
            ->onDelete('set null');
             */      
            
             $table->unsignedBigInteger('id_producto');  
             $table->foreign('id_producto')
             ->references('id')
             ->on('productos')
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
        Schema::dropIfExists('detalle_ventas');
    }
};
