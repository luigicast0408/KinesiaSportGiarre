<?php
session_start();
require_once("../../dbConnection/DB_connection.php");

header('Content-Type: application/json');

try {
    $connection = DBConnect();
} catch (Exception $e) {
    echo json_encode(["status" => 500, "message" => "Errore di connessione al database: " . $e->getMessage()]);
    exit();
}

// Controllo sessione utente
if (!isset($_SESSION['client_id'])) {
    echo json_encode(["status" => 403, "message" => "Accesso non autorizzato"]);
    exit();
}

$clientId = $_SESSION['client_id'];

// Recupero dati JSON
$data = json_decode(file_get_contents("php://input"), true);

// Controllo validità input
if (!isset($data['stage_id']) || !is_numeric($data['stage_id']) || $data['stage_id'] <= 0) {
    echo json_encode(["status" => 400, "message" => "ID evento non valido"]);
    exit();
}

$stage_id = (int)$data['stage_id']; // Conversione sicura in intero

try {
    $performanceStmt = $connection->prepare("INSERT INTO Participation (client_id, event_id) VALUES (:client_id, :event_id)");
    $performanceStmt->bindParam(':client_id', $clientId, PDO::PARAM_INT);
    $performanceStmt->bindParam(':event_id', $stage_id, PDO::PARAM_INT);
    $performanceStmt->execute();

    echo json_encode(["status" => 200, "message" => "Partecipazione registrata con successo"]);
} catch (PDOException $e) {
    if ($e->getCode() == 23000) { // Errore di violazione dei vincoli di chiave
        echo json_encode(["status" => 400, "message" => "Partecipazione già registrata o dati non validi"]);
    } else {
        echo json_encode(["status" => 500, "message" => "Errore nel tracking delle prestazioni: " . $e->getMessage()]);
    }
}

$connection = null;
?>
