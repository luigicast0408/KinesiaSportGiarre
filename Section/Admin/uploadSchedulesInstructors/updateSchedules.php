<?php
require_once ("../../../dbConnection/DB_connection.php");

try {
    $connection = DBConnect();

    if (isset($_POST['schedule_id'], $_POST['day'], $_POST['time'], $_POST['duration'])) {

        $schedule_id = $_POST['schedule_id'];
        $day_of_week = $_POST['day'];
        $start_time = $_POST['time'];
        $duration = $_POST['duration'];

        $start_time_obj = new DateTime($start_time);
        $end_time_obj = clone $start_time_obj;
        $end_time_obj->modify("+{$duration} minutes");
        $end_time = $end_time_obj->format('H:i:s');

        $query = "UPDATE InstructorSchedules 
                  SET day_of_week = :day_of_week, 
                      start_time = :start_time, 
                      end_time = :end_time 
                  WHERE instructor_schedule_id = :schedule_id";

        $stm = $connection->prepare($query);
        $stm->bindParam(':day_of_week', $day_of_week, PDO::PARAM_INT);
        $stm->bindParam(':start_time', $start_time);
        $stm->bindParam(':end_time', $end_time);
        $stm->bindParam(':schedule_id', $schedule_id, PDO::PARAM_INT);

        if ($stm->execute()) {
            header("Location: /Section/Admin/uploadSchedulesInstructors/indexUploadSchedulesInstructors.php?instructor_id=" . $_POST['instructor_id'] . "&success=1");
            exit();
        } else {
            header("Location: /Section/Admin/uploadSchedulesInstructors/indexUploadSchedulesInstructors.php?instructor_id=" . $_POST['instructor_id'] . "&error=1");
            exit();
        }
    } else {
        echo json_encode(["status" => 400, "message" => "Missing parameters."]);
        exit();
    }
} catch (PDOException $e) {
    echo json_encode(["status" => 500, "message" => "Error during the update of the schedule."]);
    exit();
}
