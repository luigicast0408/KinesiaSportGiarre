<?php
session_start();
require_once("../../dbConnection/DB_connection.php");
$connection = DBConnect();

header('Content-Type: application/json');

if (!isset($_SESSION['client_id'])) {
    echo json_encode(["status" => 403, "message" => "Accesso non autorizzato"]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $instructor_id = $_POST['instructor_id'];
    $date = $_POST['data'];
    $instructor_schedule_id = $_POST['instructor_schedule_id'];


    $checkQuery = "SELECT COUNT(*) FROM PrivateLessons WHERE instructor_schedule_id = ? AND date = ?";
    $stmt = $connection->prepare($checkQuery);
    $stmt->bindParam(1, $instructor_schedule_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $date, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo json_encode(["status" => 409, "message" => "Lezione già prenotata per questa data."]);
        exit();
    }

    $client_id = $_SESSION['client_id'];
    $insertQuery = "INSERT INTO PrivateLessons (client_id, instructor_id, date, instructor_schedule_id,status) VALUES (?, ?, ?, ?,0)";
    $insertStmt = $connection->prepare($insertQuery);
    $insertStmt->bindParam(1, $client_id, PDO::PARAM_INT);
    $insertStmt->bindParam(2, $instructor_id, PDO::PARAM_INT);
    $insertStmt->bindParam(3, $date, PDO::PARAM_STR);
    $insertStmt->bindParam(4, $instructor_schedule_id, PDO::PARAM_INT);

    if ($insertStmt->execute()) {
        echo json_encode(["status" => 200, "message" => "Lessons booking success."]);
    } else {
        echo json_encode(["status" => 500, "message" => "Error during the private booking lessons."]);
    }
} else {
    echo json_encode(["status" => 405, "message" => "Method not allowed."]);
    exit();
}
?>
