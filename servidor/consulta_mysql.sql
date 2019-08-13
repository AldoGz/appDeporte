DELIMITER $$
CREATE PROCEDURE pa_registrar_factor()
BEGIN
  DECLARE l_last_row INT DEFAULT 0;
  DECLARE p_codigo_estudiante INT;
  DECLARE cur CURSOR FOR 
  SELECT 
    codigo_estudiante 
  FROM 
    programacion_estudiante WHERE estado = 1;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET l_last_row = 1;

  OPEN cur;

  read_loop: LOOP
    FETCH cur INTO p_codigo_estudiante;
        IF ( l_last_row = 1 ) THEN
            LEAVE read_loop;
        END IF;

        INSERT INTO estudiante_factor_docente
        (
            codigo_estudiante,
            codigo_factor,
            semana,
            estado
        ) 
        VALUES 
        (
            p_codigo_estudiante,
            3,
            (SELECT WEEK(CURRENT_DATE)),
            0
        ); 

  END LOOP read_loop;
CLOSE cur;

END$$
DELIMITER ;

CREATE EVENT cambiarEstado
    ON SCHEDULE EVERY 1 WEEK
        STARTS CURRENT_TIMESTAMP
    DO
      CALL pa_registrar_factor();
      UPDATE programacion_estudiante SET estado = 1;

SET GLOBAL event_scheduler = ON;

