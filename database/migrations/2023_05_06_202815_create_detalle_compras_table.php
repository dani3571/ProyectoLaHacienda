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
        Schema::create('detalle_compras', function (Blueprint $table) {
            $table->id();
          
            $table->unsignedBigInteger('id_compra'); 
            $table->foreign('id_compra')
            ->references('id')
            ->on('compras')
            ->onDelete('cascade'); //si se elimina una compra eliminamos su detalle
          
            $table->unsignedBigInteger('id_producto');  
            $table->foreign('id_producto')
            ->references('id')
            ->on('productos')
            ->onDelete('cascade'); //si se elimina una compra eliminamos su detalle
            $table->integer('cantidad');
            $table->decimal('precio', 8);
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
        Schema::dropIfExists('detalle_compras');
    }
};
