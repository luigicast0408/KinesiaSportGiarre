<?php
session_start();
require_once("../../../dbConnection/DB_connection.php");

$connection = DBConnect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['course_id']) && isset($data['lesson_date']) && isset($data['duration'])) {
        $course_id = $data['course_id'];
        $lesson_date = $data['lesson_date'];
        $duration = $data['duration'];
        $location = $data['location'];

        $error_message = '';
        $success_message = '';

        try {
            $stmt = $connection->prepare("
                INSERT INTO Lessons (Lessons.course_id, Lessons.lesson_date, Lessons.duration,Lessons.type,Lessons.location,Lessons.price, Lessons.max_participants) 
                VALUES (:course_id, :lesson_date, :duration, 'lesson', :location, :price, :max_participants)
            ");

            $stmt->bindParam(':course_id', $course_id);
            $stmt->bindParam(':lesson_date', $lesson_date);
            $stmt->bindParam(':duration', $duration);
            $stmt->bindParam(':location', $location);
            $stmt->bindParam(':price', $data['price']);
            $stmt->bindParam(':max_participants', $data['max_participants']);

            if ($stmt->execute()) {
                $success_message = "Lesson added successfully!";
                echo json_encode(['status' => 'success', 'message' => $success_message]);
                exit();
            } else {
                $error_message = "Error adding lesson.";
                echo json_encode(['status' => 'error', 'message' => $error_message]);
            }
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            exit();
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit();
}
?>
