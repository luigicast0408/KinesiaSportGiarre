<?php
session_start();
require_once("../../../dbConnection/DB_connection.php");

$connection = DBConnect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['client_id']) && isset($_POST['response']) && isset($_POST['review_id']) ) {
        $client_id = $_POST['client_id'];
        $response = $_POST['response'];
        $review_id = $_POST['review_id'];
        echo json_encode(['status' => 'success', 'message' => $client_id.' '.$response.' '.$review_id]);
    }else{
        echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
        exit();
    }

    $error_message = '';
    $success_message = '';

    try {

        $stmt = $connection->prepare("
            UPDATE reviews 
            SET response = :response, is_response = 1 
            WHERE client_id = :client_id AND reviews_id = :review_id
        ");

        $stmt->bindParam(':response', $response);
        $stmt->bindParam(':client_id', $client_id);
        $stmt->bindParam(':review_id', $review_id);

        if ($stmt->execute()) {
            $success_message = "Response submitted successfully!";
            echo json_encode(['status' => 'success', 'message' => $success_message]);
            exit();
        }
        if (!$stmt->execute()) {
            $errorInfo = $stmt->errorInfo();
            error_log(print_r($errorInfo, true));
            $error_message = "Error submitting response.";
            echo json_encode(['status' => 'error', 'message' => $error_message]);
            exit();
        }

    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Error: " . $e->getMessage();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        exit();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit();
}
?>
