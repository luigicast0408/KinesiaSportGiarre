<?php
session_start();
require_once("../../dbConnection/DB_connection.php");
$connection = DBConnect();

header('Content-Type: application/json');

if (!isset($_SESSION['client_id'])) {
    echo json_encode(["status" => 403, "message" => "Accesso non autorizzato"]);
    exit();
}

if (!isset($_POST['lesson_id'])) {
    echo json_encode(["status" => 400, "message" => "Dati non validi"]);
    exit();
}
$lessonId = $_POST['lesson_id'];

try {
    $lessonStmt = $connection->prepare("
        SELECT lesson_id 
        FROM Lessons 
        WHERE lesson_id = :lesson_id
    ");
    $lessonStmt->bindParam(':lesson_id', $lessonId);
    $lessonStmt->execute();

    if ($lessonStmt->rowCount() > 0) {
        $lessonData = $lessonStmt->fetch(PDO::FETCH_ASSOC);

        $reservationStmt = $connection->prepare("
            INSERT INTO Reservations (lesson_id, client_id, reservation_date)
            VALUES (:lesson_id, :client_id, NOW())
        ");
        $reservationStmt->bindParam(':lesson_id', $lessonData['lesson_id']);
        $reservationStmt->bindParam(':client_id', $_SESSION['client_id']);
        $reservationStmt->execute();

        echo json_encode(["status" => 200, "message" => "Lezione prenotata con successo"]);
    } else {
        echo json_encode(["status" => 400, "message" => "Lezione non trovata"]);
    }
} catch (Exception $e) {
    echo json_encode(["status" => 500, "message" => "Errore del server: " . $e->getMessage()]);
}
