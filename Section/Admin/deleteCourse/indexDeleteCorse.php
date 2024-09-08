<?php
require_once ("../../../dbConnection/DB_connection.php");
require_once ("../../../View/includeAll_lib.php");
require_once ("../../../View/navbarAdmin.php");

$connection = DBConnect();
$courseId = isset($_GET['courseId']) ? intval($_GET['courseId']) : 0;

if ($courseId > 0) {
    try {
        $stmt = $connection->prepare("SELECT discipline, course_description, section FROM Courses WHERE course_id = :courseId");
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
    <title>Delete Course</title>
</head>
<body>
<?php renderAdminNavbar(); ?>

<div class="container-fluid">
    <div class="header">
        <h3>Delete Course</h3>
    </div>
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <div class="card-body">
            <form id="delete-course-form" method="POST" action="deleteCourse.php" enctype="multipart/form-data">
                <input type="hidden" name="courseId" value="<?php echo $courseId; ?>">
                <div class="form-group">
                    <label for="discipline">Discipline:</label>
                    <input type="text" id="discipline" name="discipline" class="form-control" value="<?php echo htmlspecialchars($course['discipline']); ?>" required readonly>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" id="description" name="description" class="form-control" value="<?php echo htmlspecialchars($course['course_description']); ?>" required readonly>
                </div>

                <div class="form-group">
                    <label for="section">Section:</label>
                    <select id="section" name="section" class="form-control" required readonly>
                        <option value="-1" <?php echo $course['section'] == -1 ? 'selected' : ''; ?>>Error</option>
                        <option value="0" <?php echo $course['section'] == 0 ? 'selected' : ''; ?>>Benessere</option>
                        <option value="1" <?php echo $course['section'] == 1 ? 'selected' : ''; ?>>Sport</option>
                    </select>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-danger" style="margin-top: 10px">Delete Course</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
