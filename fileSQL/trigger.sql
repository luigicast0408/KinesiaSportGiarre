DELIMITER //

-- Trigger per evitare che lo stesso cliente si registri più di una volta allo stesso evento
CREATE TRIGGER not_insert_more
    BEFORE INSERT ON Participation
    FOR EACH ROW
BEGIN
    DECLARE participation_count INT;
    SELECT COUNT(*)
    INTO participation_count
    FROM Participation
    WHERE client_id = NEW.client_id
      AND event_id = NEW.event_id;

    IF participation_count > 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Client already subscribed to this event';
    END IF;
END //

-- Trigger per aggiornare il campo is_admin in base al ruolo del cliente
CREATE TRIGGER is_admin_role
    AFTER UPDATE ON Clients
    FOR EACH ROW
BEGIN
    IF NEW.role = 1 THEN
        UPDATE Clients
        SET is_admin = 1
        WHERE client_id = NEW.client_id;
    ELSE
        UPDATE Clients
        SET is_admin = 0
        WHERE client_id = NEW.client_id;
    END IF;
END //

-- Trigger per evitare che un cliente si registri più di una volta allo stesso corso
DELIMITER //

CREATE TRIGGER not_insert_more_course
    BEFORE INSERT ON Registration
    FOR EACH ROW
BEGIN
    DECLARE registration_count INT;

    SELECT COUNT(*) INTO registration_count
    FROM Registration
    WHERE client_id = NEW.client_id
      AND course_id = NEW.course_id;

    IF registration_count > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Client already subscribed to this course';
    END IF;
END //


-- Trigger per controllare che il numero massimo di partecipanti a un stage non venga superato
DELIMITER //
CREATE TRIGGER max_participants
    BEFORE INSERT ON Participation
    FOR EACH ROW
    BEGIN
        DECLARE participants_count INT;
        SELECT COUNT(*) INTO participants_count
        FROM Participation
        WHERE event_id = NEW.event_id;

        IF participants_count >= (SELECT max_participation
                                  FROM Events
                                  WHERE event_id = NEW.event_id) THEN
            SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'Max number of participants reached';
        END IF;
    END //


















DELIMITER ;
