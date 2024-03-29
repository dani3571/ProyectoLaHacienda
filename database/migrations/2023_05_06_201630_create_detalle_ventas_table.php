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
            $table->unsignedBigInteger('id_venta'); 
            $table->foreign('id_venta')
            ->references('id')
            ->on('ventas')
            ->onDelete('cascade');
            $table->unsignedBigInteger('id_producto');  
            $table->foreign('id_producto')
            ->references('id')
            ->on('productos')
            ->onDelete('cascade');
            $table->decimal('subtotal', $totalDigits = 8, $decimalPlaces = 2);
            $table->integer('cantidad_individual');
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
        Schema::dropIfExists('detalle_ventas');
    }
};
