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
        DB::unprepared('DROP PROCEDURE IF EXISTS SPInsertarReservacionHotel');
        DB::unprepared('CREATE PROCEDURE SPInsertarReservacionHotel(
            p_fechaIngreso DATE,
            p_fechaSalida DATE,
            p_horaRecepcion VARCHAR(60),
            p_tratamiento_veterinaria CHAR(1),
            p_tratamiento_corte_banio CHAR(1),
            p_observaciones VARCHAR(200),
            p_zona_direccion VARCHAR(200),
            p_direccion VARCHAR(200),
            p_costo_transporte DECIMAL(8,2),
            p_costo_comida DECIMAL(8,2),
            p_costo_veterinaria DECIMAL(8,2),
            p_costo_corte_banio DECIMAL(8,2),
            p_costo_extras DECIMAL(8,2),
            p_costo_total DECIMAL(8,2),
            p_horaCheckin VARCHAR(60),
            p_horaCheckout VARCHAR(60),
            p_estado CHAR(1),
            p_usuario_id BIGINT(20) UNSIGNED,
            p_mascota_id BIGINT(20) UNSIGNED,
            p_habitacion_id BIGINT(20) UNSIGNED
          )
          NOT DETERMINISTIC
          CONTAINS SQL
          SQL SECURITY DEFINER
          BEGIN
            -- Insertamos la reserva en la tabla reservacion_hotels
            INSERT INTO reservacion_hotels (
              fechaIngreso,
              fechaSalida,
              horaRecepcion,
              tratamiento_veterinaria,
              tratamiento_corte_banio,
              observaciones,
              zona_direccion,
              direccion,
              costo_transporte,
              costo_comida,
              costo_veterinaria,
              costo_corte_banio,
              costo_extras,
              costo_total,
              horaCheckin,
              horaCheckout,
              estado,
              usuario_id,
              mascota_id,
              habitacion_id
            ) VALUES (
              p_fechaIngreso,
              p_fechaSalida,
              p_horaRecepcion,
              p_tratamiento_veterinaria,
              p_tratamiento_corte_banio,
              p_observaciones,
              p_zona_direccion,
              p_direccion,
              p_costo_transporte,
              p_costo_comida,
              p_costo_veterinaria,
              p_costo_corte_banio,
              p_costo_extras,
              p_costo_total,
              p_horaCheckin,
              p_horaCheckout,
              p_estado,
              p_usuario_id,
              p_mascota_id,
              p_habitacion_id
            );
            
            -- Actualizamos el estado de la habitación a 2
            UPDATE habitacions SET estado = 2 WHERE id = p_habitacion_id;
          END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropifExists('SPInsertarReservacionHotel');
    }
};
