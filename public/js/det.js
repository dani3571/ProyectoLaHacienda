/*
DELIMITER //

CREATE PROCEDURE InsertarReservacionHotelYActualizarHabitacion(
    IN p_fechaIngreso DATE,
    IN p_fechaSalida DATE,
    IN p_tratamientos VARCHAR(200),
    IN p_tranporte DECIMAL(8,2),
    IN p_comida DECIMAL(8,2),
    IN p_banioYCorte DECIMAL(8,2),
    IN p_tratamiento DECIMAL(8,2),
    IN p_extras DECIMAL(8,2),
    IN p_total DECIMAL(8,2),
    IN p_estado CHAR(1),
    IN p_usuario_id BIGINT(20),
    IN p_mascota_id BIGINT(20),
    IN p_habitacion_id INT(11)
)
BEGIN
    DECLARE v_reservacionHotel_id BIGINT(20);
    
    -- Insertar en la tabla reservacion_hotels
    INSERT INTO reservacion_hotels (
        fechaIngreso,
        fechaSalida,
        tratamientos,
        tranporte,
        comida,
        banioYCorte,
        tratamiento,
        extras,
        total,
        estado,
        usuario_id,
        mascota_id,
        created_at,
        updated_at
    ) VALUES (
        p_fechaIngreso,
        p_fechaSalida,
        p_tratamientos,
        p_tranporte,
        p_comida,
        p_banioYCorte,
        p_tratamiento,
        p_extras,
        p_total,
        p_estado,
        p_usuario_id,
        p_mascota_id,
        CURRENT_TIMESTAMP,
        CURRENT_TIMESTAMP
    );
    
    -- Obtener el ID de la reservacion_hotels recién insertada
    SET v_reservacionHotel_id = LAST_INSERT_ID();
    
    -- Actualizar el campo reservacionHotel_id en la tabla habitacions
    UPDATE habitacions
    SET reservacionHotel_id = v_reservacionHotel_id
    WHERE id = p_habitacion_id;
    
END //

DELIMITER ;



CALL InsertarReservacionHotelYActualizarHabitacion(
    '2023-06-01',
    '2023-06-05',
    'Tratamiento de SPA',
    50.00,
    20.00,
    10.00,
    30.00,
    5.00,
    115.00,
    '1',
    1,
    1,
    2
);




--ACtualizar
DELIMITER //

CREATE PROCEDURE ActualizarReservacionHotel(
    IN p_reservacionHotel_id BIGINT(20),
    IN p_fechaIngreso DATE,
    IN p_fechaSalida DATE,
    IN p_tratamientos VARCHAR(200),
    IN p_tranporte DECIMAL(8,2),
    IN p_comida DECIMAL(8,2),
    IN p_banioYCorte DECIMAL(8,2),
    IN p_tratamiento DECIMAL(8,2),
    IN p_extras DECIMAL(8,2),
    IN p_total DECIMAL(8,2),
    IN p_estado CHAR(1),
    IN p_usuario_id BIGINT(20),
    IN p_mascota_id BIGINT(20),
    IN p_habitacion_id INT(11)
)
BEGIN
    -- Actualizar la reserva existente en la tabla reservacion_hotels
    UPDATE reservacion_hotels
    SET fechaIngreso = p_fechaIngreso,
        fechaSalida = p_fechaSalida,
        tratamientos = p_tratamientos,
        tranporte = p_tranporte,
        comida = p_comida,
        banioYCorte = p_banioYCorte,
        tratamiento = p_tratamiento,
        extras = p_extras,
        total = p_total,
        estado = p_estado,
        usuario_id = p_usuario_id,
        mascota_id = p_mascota_id,
        updated_at = CURRENT_TIMESTAMP
    WHERE id = p_reservacionHotel_id;
    
    -- Actualizar el campo reservacionHotel_id en la tabla habitacions
    UPDATE habitacions
    SET reservacionHotel_id = p_reservacionHotel_id
    WHERE id = p_habitacion_id;
    
END //

DELIMITER ;




CALL ActualizarReservacionHotel(
    <p_reservacionHotel_id>,
    <p_fechaIngreso>,
    <p_fechaSalida>,
    <p_tratamientos>,
    <p_tranporte>,
    <p_comida>,
    <p_banioYCorte>,
    <p_tratamiento>,
    <p_extras>,
    <p_total>,
    <p_estado>,
    <p_usuario_id>,
    <p_mascota_id>,
    <p_habitacion_id>
);




CALL ActualizarReservacionHotel(
    1,
    '2023-06-01',
    '2023-06-05',
    'Tratamiento de SPA',
    50.00,
    20.00,
    10.00,
    30.00,
    5.00,
    115.00,
    '1',
    1,
    1,
    2
);

*/