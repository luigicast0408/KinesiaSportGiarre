<?php
require_once("db_connection.php"); // Connessione al database

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

// Controllo se tutti i dati richiesti sono stati forniti
if (!isset($data["client_id"], $data["date"], $data["start_time"], $data["end_time"])) {
    echo json_encode(["status" => 400, "message" => "Dati mancanti per la prenotazione."]);
    exit;
}

$client_id = (int) $data["client_id"];
$date = $data["date"];
$start_time = $data["start_time"];
$end_time = $data["end_time"];

try {
    $pdo = new PDO("mysql:host=localhost;dbname=your_database", "your_username", "your_password", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // Controlla se l'orario è già prenotato (evita sovrapposizioni)
    $stmt = $pdo->prepare("
        SELECT COUNT(*) 
        FROM PrivateLessons 
        WHERE course_id = :client_id 
        AND date = :date 
        AND (
            (:start_time BETWEEN time_start AND time_end) OR 
            (:end_time BETWEEN PrivateLessons.time_start AND time_end) OR 
            (time_start BETWEEN :start_time AND :end_time) OR 
            (time_end BETWEEN :start_time AND :end_time)
        )
    ");
    $stmt->execute([
        ":client_id" => $client_id,
        ":date" => $date,
        ":start_time" => $start_time,
        ":end_time" => $end_time
    ]);

    if ($stmt->fetchColumn() > 0) {
        echo json_encode(["status" => 409, "message" => "L'orario selezionato è già prenotato."]);
        exit;
    }

    // Inserisce la nuova prenotazione
    $stmt = $pdo->prepare("
        INSERT INTO PrivateLessons (date, status, price, course_id, time_start, time_end) 
        VALUES (:date, 0, 0, :course_id, :start_time, :end_time)
    ");
    $stmt->execute([
        ":date" => $date,
        ":course_id" => $client_id,
        ":start_time" => $start_time,
        ":end_time" => $end_time
    ]);

    echo json_encode(["status" => 200, "message" => "Prenotazione confermata!"]);

} catch (PDOException $e) {
    echo json_encode(["status" => 500, "message" => "Errore nel database: " . $e->getMessage()]);
}

