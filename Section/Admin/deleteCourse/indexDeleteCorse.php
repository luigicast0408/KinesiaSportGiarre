<?php
require_once ("../../../dbConnection/DB_connection.php");
require_once ("../../../View/includeAll_lib.php");
require_once ("../../../View/navbarAdmin.php");
require_once ("../../../View/headerAdmin.php");
require_once ("../../../View/footerAdmin.php");

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
<?php
echo renderAdminNavbar();
echo renderAdminHeader("Delete Course");
?>
<div class="container-fluid">
    <div class="card shadow-lg rounded-3 border-0" style="max-width: 600px; margin: 50px auto;">
        <div class="card-body">
            <form id="delete-course-form" method="POST" action="deleteCourse.php" enctype="multipart/form-data" class="bg-white p-4 rounded-3 shadow-sm">
                <input type="hidden" name="courseId" value="<?php echo $courseId; ?>">

                <!-- Titolo Card -->
                <h4 class="text-center mb-4 text-primary font-weight-bold">Delete Course</h4>

                <!-- Campo Discipline -->
                <div class="form-group mb-3">
                    <label for="discipline" class="form-label font-weight-semibold">Discipline:</label>
                    <input type="text" id="discipline" name="discipline" class="form-control" value="<?php echo htmlspecialchars($course['discipline']); ?>" required readonly>
                </div>

                <!-- Campo Description -->
                <div class="form-group mb-3">
                    <label for="description" class="form-label font-weight-semibold">Description:</label>
                    <input type="text" id="description" name="description" class="form-control" value="<?php echo htmlspecialchars($course['course_description']); ?>" required readonly>
                </div>

                <!-- Campo Section -->
                <div class="form-group mb-3">
                    <label for="section" class="form-label font-weight-semibold">Section:</label>
                    <select id="section" name="section" class="form-select" required readonly>
                        <option value="-1" <?php echo $course['section'] == -1 ? 'selected' : ''; ?>>Error</option>
                        <option value="0" <?php echo $course['section'] == 0 ? 'selected' : ''; ?>>Benessere</option>
                        <option value="1" <?php echo $course['section'] == 1 ? 'selected' : ''; ?>>Sport</option>
                    </select>
                </div>

                <!-- Pulsante Delete -->
                <div class="form-group text-center mt-4">
                    <button type="submit" class="btn btn-danger btn-lg px-5 py-3 shadow-lg border-0 rounded-pill hover-shadow">Delete Course</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php echo renderAdminFooter() ?>

</body>
</html>
