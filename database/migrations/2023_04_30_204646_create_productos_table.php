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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->string('descripcion', 255);
            $table->string('precio', 255);
            $table->integer('cantidad')->nullable();
            $table->string('image', 255);
            $table->date('fecha_compra')->default(now());
            $table->date('fecha_vencimiento')->nullable()->default(null);
            //si es 0 no disponible / si es 1 disponible
            $table->char('Estado')->default(1);
        
                //Foreign keys
                $table->unsignedBigInteger('categoria_id'); 
                $table->foreign('categoria_id')
                ->references('id')
                ->on('categorias')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('productos');
    }
};
