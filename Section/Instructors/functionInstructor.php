<?php
require_once ("../../dbConnection/DB_connection.php");

function showInstructor(): void {
    $connection = DBConnect();

    $query = "SELECT * FROM Clients WHERE role = 1";
    $statement = $connection->prepare($query);
    $statement->execute();
    $instructor = $statement->fetchAll();
    ob_start();
    ?>
    <div class="container-fluid mt-5">
        <div class="row">
            <?php foreach ($instructor as $index => $ins): ?>
            <?php $class = "card-bg-" . $index; ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-lg border-light rounded-lg">
                    <img class="card-img-top rounded-top" src="<?= ($ins['image_link']) ?>" alt="<?= ($ins['first_name'].' '.$ins['last_name']) ?>" style="object-fit: cover; height: 200px;">
                    <div class="card-body text-center">
                        <h5 class="card-title text-dark"><?=($ins['first_name']).' '.$ins['last_name']?></h5>
                        <p class="card-text text-muted"><?=($ins['description'])?></p>
                        <p class="card-text"><strong>Phone:</strong> <?=($ins['phone_number'])?></p>
                        <p class="card-text"><strong>Email:</strong> <?=($ins['email'])?></p>
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
