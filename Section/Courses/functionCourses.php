<?php
require_once ("dbConnection/DB_connection.php");
function showCourses($value) {
$connection = DBConnect();

$query = "SELECT * FROM Courses WHERE type='unit' AND partKinesi= $value";
$statement = $connection->prepare($query);
$statement->execute();
$courses = $statement->fetchAll();
ob_start();
?>
<div class="container-fluid">
    <div class="row">
        <?php foreach ($courses as $index => $course): ?>
        <?php $class = "card-bg-" . $index; ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 <?= $class ?>">
                <img class="card-img-top" src="<?= htmlspecialchars($course['image']) ?>" alt="">
                <div class="card-body">
                    <h4 class="card-title"><?= htmlspecialchars($course['discipline']) ?></h4>
                    <p class="card-text"><?= htmlspecialchars($course['course_description']) ?></p>
                    <p class="card-text"><?= $course['partKinesia'] == 0 ? 'benessere' : 'altro' ?></p>
                </div>
            </div>
        </div>
        <?php if (($index + 1) % 3 == 0): ?>
    </div><div class="row">
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
<?php
    echo ob_get_clean();
}
?>
