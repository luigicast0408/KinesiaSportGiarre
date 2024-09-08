<?php
require_once("../../../dbConnection/DB_connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $discipline = isset($_POST['discipline']) ? trim($_POST['discipline']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $section= isset($_POST['section']) ? trim($_POST['section']) : '';

    if (empty($discipline) || empty($description) || empty($section)) {
        echo "<h3>Error: All fields are required.</h3>";
        exit;
    }

    $connection = DBConnect();
    $type = 'unit';
    try {

        $stmt = $connection->prepare("INSERT INTO Courses (type, discipline, price, course_description, image_link,section) VALUES (:type, :discipline, 0, :description, ' ',:section)");
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':discipline', $discipline);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':section', $section);

        if ($stmt->execute()) {
            echo "<h3>Course added successfully!</h3>";
        } else {
            echo "<h3>Error: Could not add the course. Please try again.</h3>";
        }
    } catch (PDOException $e) {
        echo "<h3>Error: Database error - " . $e->getMessage() . "</h3>";
    }
} else {
    echo "<h3>Error: Invalid request method.</h3>";
}
?>
