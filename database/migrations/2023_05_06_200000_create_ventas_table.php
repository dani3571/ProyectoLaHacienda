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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id(); 
            $table->string('usuario', 50);
            $table->string('cliente', 50); 
            $table->decimal('cantidad', $totalDigits = 8, $decimalPlaces = 2);
            $table->decimal('total', $totalDigits = 8, $decimalPlaces = 2);
            $table->date('fechaVenta');
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
        Schema::dropIfExists('ventas');
    }
};
