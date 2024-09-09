<?php
require_once ("../../dbConnection/DB_connection.php");
require_once ("../../View/errorMessage.php");

$connection = DBConnect();
$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_id = $_SESSION['client_id'];
    $course_id = $_POST['course'];
    $rating = intval($_POST['rating']);
    $comment = $_POST['comment'];
    $response = '';

    try {
        $stmt = $connection->prepare("INSERT INTO Reviews (client_id, course_id, rating, comment, response)
                                      VALUES (:client_id, :course_id, :rating, :comment, :response)");
        $stmt->bindParam(':client_id', $client_id);
        $stmt->bindParam(':course_id', $course_id);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':response', $response);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Recensione inviata con successo!";
            header("Location: ../../View/successPage.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Errore durante l'invio della recensione.";
            header("Location: ../../View/errorPage.php");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Errore: " . $e->getMessage();
        header("Location: ../../View/errorPage.php");
        exit();
    }
}


if ($error_message) {
    $_SESSION['error_message'] = $error_message;
    header("Location: ../../View/errorPage.php");
    exit();
}

?>