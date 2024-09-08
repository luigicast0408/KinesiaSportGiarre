<?php
require_once("../../../dbConnection/config.php");
require_once("../../../dbConnection/DB_connection.php");
$connection=DBConnect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courseId = isset($_POST['courseId']) ? intval($_POST['courseId']) : 0;
    $discipline = isset($_POST['discipline']) ? $_POST['discipline'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';

    if (empty($courseId) || empty($discipline) || empty($description)) {
        echo "<h3>Error: Missing required fields.</h3>";
        exit;
    }

    try {
        $stmt = $connection->prepare("UPDATE Courses SET discipline = :discipline, course_description = :description WHERE course_id = :courseId");
        $stmt->bindParam(':discipline', $discipline);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':courseId', $courseId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "<h3>Success: Course updated successfully.</h3>";
        } else {
            echo "<h3>Error: Failed to update course.</h3>";
        }
    } catch (PDOException $e) {
        echo "<h3>Error: Database error - " . $e->getMessage() . "</h3>";
    }
} else {
    echo "<h3>Error: Method not allowed.</h3>";
}
