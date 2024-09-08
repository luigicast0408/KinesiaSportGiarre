<?php
require_once ("../../../dbConnection/DB_connection.php");
require_once ("../../../View/includeAll_lib.php");
require_once ("../../../View/navbarAdmin.php");

// Database connection and course retrieval logic
$connection = DBConnect();
$courseId = isset($_GET['courseId']) ? intval($_GET['courseId']) : 0;

if ($courseId > 0) {
    try {
        $stmt = $connection->prepare("SELECT discipline, course_description, image_link FROM Courses WHERE course_id = :courseId");
        $stmt->bindParam(':courseId', $courseId, PDO::PARAM_INT);
        $stmt->execute();

        $course = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$course) {
            echo "<h3>Error: Course not found.</h3>";
            exit;
        }
    } catch (PDOException $e) {
        echo "<h3>Error: Database error - " . $e->getMessage() . "</h3>";
        exit;
    }
} else {
    echo "<h3>Error: Invalid course ID.</h3>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../../style/style_footer.css">
    <link rel="stylesheet" type="text/css" href="../../../style/style_nav.css">
    <link rel="stylesheet" type="text/css" href="../../../style/style_cards.css">
    <link rel="stylesheet" type="text/css" href="../../../style/style_header.css">
    <?php includeStyles(); ?>
    <title>Edit Course</title>
</head>
<body>
<?php renderAdminNavbar(); ?>

<div class="container-fluid">
    <div class="header">
        <h3>Edit Course</h3>
    </div>
    <div class="card">
        <div class="card-body ">
            <form id="update-course-form" method="POST" action="updateCourse.php">
                <input type="hidden" name="courseId" value="<?php echo $courseId; ?>">

                <div class="form-group">
                    <label for="discipline">Discipline:</label>
                    <input type="text" id="discipline" name="discipline" class="form-control" value="<?php echo htmlspecialchars($course['discipline']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" id="description" name="description" class="form-control" value="<?php echo htmlspecialchars($course['course_description']); ?>" required>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Update Course</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
