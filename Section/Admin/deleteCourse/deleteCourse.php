<?php

require_once("../../../dbConnection/DB_connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courseId = isset($_POST['courseId']) ? intval($_POST['courseId']) : 0;
    echo $courseId;

    if ($courseId > 0) {
        $connection = DBConnect();

        try {
            $stmt = $connection->prepare("SELECT image_link FROM Courses WHERE course_id = :courseId");
            $stmt->bindParam(':courseId', $courseId, PDO::PARAM_INT);
            $stmt->execute();
            $course = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($course) {
                $deleteStmt = $connection->prepare("DELETE FROM Courses WHERE course_id = :courseId");
                $deleteStmt->bindParam(':courseId', $courseId, PDO::PARAM_INT);

                if ($deleteStmt->execute()) {
                    $imagePath = $course['image_link'];
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                    echo "<h3>Course deleted successfully!</h3>";
                } else {
                    echo "<h3>Error: Could not delete the course. Please try again.</h3>";
                }
            } else {
                echo "<h3>Error: Course not found.</h3>";
            }
        } catch (PDOException $e) {
            echo "<h3>Error: Database error - " . $e->getMessage() . "</h3>";
        }
    } else {
        echo "<h3>Error: Invalid course ID.</h3>";
    }
} else {
    echo "<h3>Error: Invalid request method.</h3>";
}
