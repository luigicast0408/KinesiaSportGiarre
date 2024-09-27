<?php
require_once ("../../../dbConnection/DB_connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connection = DBConnect();

    $instructor_id = $_POST['instructor_id'];
    $day = $_POST['day'];
    $start_time = $_POST['time'];
    $duration = $_POST['duration'];

    $startDateTime = new DateTime($start_time);
    $startDateTime->modify("+$duration minutes");
    $end_time = $startDateTime->format('H:i:s');

    $query = "INSERT INTO InstructorSchedules (instructor_id, start_time, end_time, day_of_week) 
              VALUES (:instructor_id, :start_time, :end_time, :day_of_week)";

    $stm = $connection->prepare($query);
    $stm->bindParam(':instructor_id', $instructor_id);
    $stm->bindParam(':start_time', $start_time);
    $stm->bindParam(':end_time', $end_time);
    $stm->bindParam(':day_of_week', $day);
    $stm->execute();

    echo json_encode(["status" => 200, "message" => "Schedule add with success."]);
} else {
    echo json_encode(["status" => 405, "message" => "Method not allowed."]);
    exit();
}
