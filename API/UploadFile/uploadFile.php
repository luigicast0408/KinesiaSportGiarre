<?php

require_once("../../dbConnection/config.php");
require_once("../../dbConnection/DB_connection.php");
$conn = DBConnect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file']) && isset($_POST['client_id'])) {
        $clientId = $_POST['client_id'];
        $file = $_FILES['file'];
        $clientId=(int)$clientId;

        if (!is_numeric($clientId)) {
            echo json_encode(["status" => 400, "message" => "Invalid client ID. (N)"]);
            exit();
        }
        $targetDir = "../../uploads/clients/{$clientId}/";

        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $targetFilePath = $targetDir . basename($file['name']);

        if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            if (saveFileToDatabase($clientId, $file['name'], $targetFilePath)) {
                echo json_encode(["status" => 200, "message" => "File uploaded and saved successfully."]);
            } else {
                echo json_encode(["status" => 500, "message" => "File uploaded but failed to save to the database."]);
            }
        } else {
            echo json_encode(["status" => 500, "message" => "Error moving uploaded file."]);
        }
    } else {
        echo json_encode(["status" => 400, "message" => "Invalid request. Client ID is missing."]);
    }
} else {
    echo json_encode(["status" => 405, "message" => "Method not allowed."]);
}

function saveFileToDatabase($clientId, $fileName, $filePath){
    global $conn;
    $sql = "INSERT INTO uploaded_files (client_id, file_name, file_path) VALUES (:id, :name, :path)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        error_log("Database prepare error: " . print_r($conn->errorInfo(), true));
        return false;
    }

    $stmt->bindParam(":id", $clientId);
    $stmt->bindParam(":name", $fileName);
    $stmt->bindParam(":path", $filePath);

    if ($stmt->execute()) {
        return true;
    } else {
        error_log("Database insert error: " . print_r($stmt->errorInfo(), true));
        return false; // Failed to insert file info
    }
}
