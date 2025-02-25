
-- 2. login
SELECT client_id,first_name,
       last_name,username,
       password,is_admin
FROM Clients
WHERE username = :username;

-- 4. Visulizzazione Corsi (benessere)
SELECT *
FROM Courses
WHERE type = 'unit'
  AND section = 0;

-- 4 Visulizzazione Corsi (sport)
SELECT *
FROM Courses
WHERE type = 'unit'
  AND section = 1;

-- 5. Visulizzazione lezioni private pronotate dai clienti
CREATE VIEW j_cl_r_cr AS
SELECT Clients.client_id,
       Clients.first_name,
       Clients.last_name,
       Registration.course_id,
       Courses.discipline,
       Courses.type
FROM Clients
         JOIN Registration ON Clients.client_id = Registration.client_id
         JOIN Courses ON Registration.course_id = Courses.course_id;


SELECT *
FROM j_cl_r_cr
         JOIN PrivateLessons ON j_cl_r_cr.course_id = PrivateLessons.course_id
WHERE date = :date
  AND client_id = :client_id;


-- 6 visulizzazione orari istruttori
SELECT first_name, last_name, start_time, end_time, day_of_week
FROM Clients,
     Schedules
WHERE Clients.client_id = Schedules.client_id;

-- 7.3 viuslizzazione eventi
SELECT *
FROM Events
WHERE type = 'saggio';

-- 7.4 visulizzazione partecipazione evento
SELECT first_name, last_name
FROM Clients,Participation,Events
WHERE Clients.client_id = Participation.client_id
    AND Events.event_id = Participation.event_id;

-- 8.3 Visulizzazione galleria evento
SELECT image_link
FROM Events,
     EventGallery
WHERE Events.event_id = EventGallery.event_id
  AND Events.event_id = :event_id;

-- 9. Visulizzazione recenzioni con ripsosta e senza risposta
SELECT  Reviews.client_id, Clients.first_name, Clients.last_name, Clients.email, Clients.phone_number, Reviews.rating, Reviews.comment
FROM Reviews
JOIN Clients ON Clients.client_id = Reviews.client_id
WHERE is_response = 0;

SELECT  Reviews.client_id, Clients.first_name, Clients.last_name, Clients.email, Clients.phone_number, Reviews.rating, Reviews.comment
FROM Reviews
JOIN Clients ON Clients.client_id = Reviews.client_id
WHERE is_response = 1;

-- 10.4 Visualizzare partecipanti ad uno stage
SELECT *
FROM Clients,
     Participation,
     Events
WHERE Clients.client_id = Participation.client_id
  AND Events.event_id = Participation.event_id;

-- 11.1 Visualizzazione istruttori
SELECT first_name, last_name, phone_number, email
FROM Clients
WHERE role = 1;

-- 11.2 Visualizzazione utenti
SELECT first_name, last_name, phone_number, email
FROM Clients
WHERE role = 0;

-- Visualizzazione report
-- 12 Ottenere il numero di corsi attivi
SELECT COUNT(*)
FROM Courses
WHERE type = 'unit';

-- 12.1 Ottenere il numero di recensioni che hanno una risposta
SELECT COUNT(*)
FROM Reviews
WHERE is_response = 1;

-- 12.2 Ottenere il numero di recensioni che non  hanno una risposta
SELECT COUNT(*)
FROM Reviews
WHERE is_response = 0;


-- 12.3 Visualizzazioine di tutte le partecipazioni agli stage
SELECT *
FROM Clients,Participation,Events
WHERE Clients.client_id = Participation.client_id
  AND Participation.event_id = Events.event_id
  AND Events.type = 'stage'
  AND date >= CURRENT_DATE();

-- 12.4 Visualizzazioine di tutte registrazioni ai corsi
SELECT course_id,discipline,
       (SELECT COUNT(*) AS total
        FROM Registration
        WHERE Registration.course_id = Courses.course_id) AS num_iscritti
FROM Courses;

-- 12.5 Visualizzare l'eveento con il maggior numero di partecipanti
SELECT COUNT(*) As number_event
FROM Events
WHERE event_id = (SELECT event_id
                  FROM Participation
                  GROUP BY event_id
                  ORDER BY COUNT(client_id)
                  LIMIT 1);

-- 12. 6 Visualizzare i clienti che hanno fatto recensioni
SELECT client_id, first_name, last_name
FROM Clients
WHERE client_id IN (
    SELECT DISTINCT client_id
    FROM Reviews);

-- 12.7 Visualizza l’evento più polare rispetto alla media
SELECT event_id, event_name, location
FROM Events
WHERE event_id IN (
    SELECT event_id
    FROM Participation
    GROUP BY event_id
    HAVING COUNT(client_id) > (
        SELECT AVG(participants_count)
        FROM (SELECT event_id, COUNT(client_id) AS participants_count
              FROM Participation
              GROUP BY event_id) AS avg_participation
    )
);

-- 13.1 Visulizzazione schede allenamento
SELECT *
FROM UserFiles
WHERE client_id = :client_id;


