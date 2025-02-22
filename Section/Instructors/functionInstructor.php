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
    <div class="container mt-5">
        <div class="row justify-content-center">
            <?php foreach ($instructor as $index => $ins): ?>
            <div class="col-md-4 mb-4 d-flex align-items-stretch">
                <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
                    <img class="card-img-top" src="<?= $ins['image_link'] ?>"
                         alt="<?= $ins['first_name'] . ' ' . $ins['last_name'] ?>"
                         style="object-fit: cover; height: 890px; width: 100%;">

                    <div class="card-body text-center">
                        <h5 class="card-title text-dark fw-bold"><?= $ins['first_name'] . ' ' . $ins['last_name'] ?></h5>
                        <p class="card-text text-muted"><?= $ins['description'] ?></p>
                    </div>

                    <div class="card-footer bg-white text-center">
                        <p class="mb-1"><i class="fas fa-phone-alt text-success"></i> <?= $ins['phone_number'] ?></p>
                        <p><i class="fas fa-envelope text-primary"></i> <?= $ins['email'] ?></p>

                        <a href="mailto:<?= $ins['email'] ?>" class="btn btn-primary btn-sm mt-2">
                            <i class="fas fa-paper-plane"></i> Contatta
                        </a>
                    </div>
                </div>
            </div>

            <?php if (($index + 1) % 3 == 0): ?>
        </div><div class="row justify-content-center">
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <?php
    echo ob_get_clean();
    $connection=null;
}
?>
