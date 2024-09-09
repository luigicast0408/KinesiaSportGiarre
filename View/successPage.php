<?php
session_start();
require_once ("../View/errorMessage.php");
require_once ("../View/navbar.php");
require_once ("../View/footer.php");
require_once ("../View/includeAll_lib.php");

$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : 'Operazione completata con successo!';
unset($_SESSION['success_message']);

?>

    <!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../style/style_footer.css">
        <link rel="stylesheet" type="text/css" href="../style/style_nav.css">
        <link rel="stylesheet" type="text/css" href="../style/style_cards.css">
        <link rel="stylesheet" type="text/css" href="../style/style_header.css">
        <?php includeStyles()?>
        <title>Successo</title>
    </head>
    <body>
    <?php navbar() ?>

    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <h3 class="card-title text-center mb-4">Operazione Completata</h3>
                        <div class="alert alert-success" role="alert">
                            <?php echo htmlspecialchars($success_message); ?>
                        </div>
                        <div class="text-center">
                            <a href="../Section/Home/index.php" class="btn btn-primary">Torna alla Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php generateFooter(); ?>
    </body>
    </html>
<?php
