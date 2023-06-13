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
        DB::unprepared('DROP PROCEDURE IF EXISTS SPActualizarReservacionHotel');
        DB::unprepared('CREATE PROCEDURE SPActualizarReservacionHotel(
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
            p_habitacion_id BIGINT(20) UNSIGNED,
            p_habitacion_id_nuevo BIGINT(20) UNSIGNED
        )
        BEGIN
            DECLARE v_habitacion_id_actual BIGINT(20) UNSIGNED;
            
            -- Obtenemos el habitacion_id actual de la reserva
            SELECT habitacion_id INTO v_habitacion_id_actual FROM reservacion_hotels WHERE habitacion_id = p_habitacion_id LIMIT 1;
            
            -- Verificamos si el habitacion_id ha cambiado
            IF v_habitacion_id_actual <> p_habitacion_id_nuevo THEN
                -- Actualizamos el estado de la habitacion_id original a 1
                UPDATE habitacions SET estado = 1 WHERE id = p_habitacion_id;
                
                -- Actualizamos el estado de la habitacion_id nueva a 2
                UPDATE habitacions SET estado = 2 WHERE id = p_habitacion_id_nuevo;
                
                -- Actualizamos el habitacion_id de la reserva
                UPDATE reservacion_hotels SET habitacion_id = p_habitacion_id_nuevo WHERE habitacion_id = p_habitacion_id;
            END IF;
            
            -- Actualizamos los demás valores de la reserva
            UPDATE reservacion_hotels SET
                fechaIngreso = p_fechaIngreso,
                fechaSalida = p_fechaSalida,
                horaRecepcion = p_horaRecepcion,
                tratamiento_veterinaria = p_tratamiento_veterinaria,
                tratamiento_corte_banio = p_tratamiento_corte_banio,
                observaciones = p_observaciones,
                zona_direccion = p_zona_direccion,
                direccion = p_direccion,
                costo_transporte = p_costo_transporte,
                costo_comida = p_costo_comida,
                costo_veterinaria = p_costo_veterinaria,
                costo_corte_banio = p_costo_corte_banio,
                costo_extras = p_costo_extras,
                costo_total = p_costo_total,
                horaCheckin = p_horaCheckin,
                horaCheckout = p_horaCheckout,
                estado = p_estado,
                usuario_id = p_usuario_id,
                mascota_id = p_mascota_id
            WHERE habitacion_id = p_habitacion_id_nuevo;
        END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropifExists('SPActualizarReservacionHotel');
    }
};
