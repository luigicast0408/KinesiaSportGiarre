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

        $error_message = '';
        $success_message = '';

        try {
            $stmt = $connection->prepare("
                INSERT INTO Lessons (course_id, lesson_date, duration) 
                VALUES (:course_id, :lesson_date, :duration)
            ");

            $stmt->bindParam(':course_id', $course_id);
            $stmt->bindParam(':lesson_date', $lesson_date);
            $stmt->bindParam(':duration', $duration);

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
