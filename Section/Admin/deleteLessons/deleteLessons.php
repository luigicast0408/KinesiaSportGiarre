<?php
session_start();
require_once("../../../dbConnection/DB_connection.php");

header('Content-Type: application/json');

$connection = DBConnect();

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id'])) {
        $lesson_id = $data['id'];

        try {
            $stmt = $connection->prepare("DELETE FROM Lessons WHERE lesson_id = :id");
            $stmt->bindParam(':id', $lesson_id);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Lesson deleted successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error during deletion.']);
            }
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Missing required  id lessons.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Method  of request not allowed.']);
}
?>
<?php
