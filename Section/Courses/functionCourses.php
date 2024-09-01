<?php
require_once ("../../dbConnection/DB_connection.php");
function showCourses($value) {
$connection = DBConnect();
$query = "SELECT * FROM Courses WHERE type='unit' AND section= $value";
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
                <img class="card-img-top" src="<?= ($course['image_link']) ?>" alt="">
                <h4 class="card-title"><?= ($course['discipline']) ?></h4>
                <div class="card-body">
                    <p class="card-text"><?=($course['course_description']) ?></p>
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
    $connection=null;
}
?>
