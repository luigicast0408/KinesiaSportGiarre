<?php
session_start();
require_once ("../../../dbConnection/DB_connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {

        $client_id =($_SESSION['client_id']);
        $day = ($_POST['day']);
        $start_time = ($_POST['time_start']);
        $end_time = ($_POST['time_end']);

        $connection = DBConnect();


        $query = "INSERT INTO Schedules (client_id, start_time, end_time, day_of_week) 
                  VALUES (:client_id, :start_time, :end_time, :day_of_week)";

        $stm = $connection->prepare($query);
        $stm->bindParam(':client_id', $client_id, PDO::PARAM_INT);
        $stm->bindParam(':start_time', $start_time);
        $stm->bindParam(':end_time', $end_time);
        $stm->bindParam(':day_of_week', $day, PDO::PARAM_INT);

        if ($stm->execute()) {
            header('Location: ../indexAdmin.php');
        } else {
            echo '<h3> ERRORE NEL INSERIMENTO</h3>';
        }
    } catch (Exception $e) {
        echo json_encode(["status" => 500, "message" => "Errore del server: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => 405, "message" => "Metodo non consentito"]);
}
