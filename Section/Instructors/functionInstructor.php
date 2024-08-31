<?php
require_once ("../../dbConnection/DB_connection.php");
function showInstructor(): void {
    $connection = DBConnect();

    $query = "SELECT * FROM Instructors";
    $statement = $connection->prepare($query);
    $statement->execute();
    $instructor = $statement->fetchAll();
    ob_start();
    ?>
    <div class="container-fluid">
        <div class="row">
            <?php foreach ($instructor as $index => $ins): ?>
            <?php $class = "card-bg-" . $index; ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 <?= $class ?>">
                    <img class="card-img-top" src="<?= ($ins['image_link']) ?>" alt="">
                    <div class="card-body">
                        <p class="card-text"><?=($ins['first_name']).' '.$ins['last_name']?></p>
                        <p class="card-text"><?=($ins['description'])?></p>
                        <p class="card-text"><?=($ins['phone_number'])?></p>
                        <p class="card-text"><?=($ins['email'])?></p>
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
