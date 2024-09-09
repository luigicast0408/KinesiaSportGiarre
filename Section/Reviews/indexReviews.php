<?php
require_once ("../../dbConnection/DB_connection.php");
require_once ("../../View/includeAll_lib.php");
require_once ("../../View/navbar.php");
require_once ("../../View/footer.php");
require_once ("../../View/errorMessage.php");
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../style/style_footer.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_nav.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_cards.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_header.css">
    <?php includeStyles(); ?>
    <title>Lascia una Recensione</title>
</head>
<body>
<?php navbar(); ?>

<?php

if (!isset($_SESSION['client_id'])) {
    $error_message = "Non puoi lasciare una recensione se non hai effettuato il login.";
    showMessage($error_message, 'danger');
    exit();
}

?>
<section class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <h3 class="card-title text-center mb-4">Lascia una Recensione</h3>
                    <form method="POST" action="addReviews.php">

                        <div class="mb-3">
                            <label for="rating" class="form-label">Valutazione (1-5):</label>
                            <select id="rating" name="rating" class="form-select" required>
                                <option value="">Seleziona una valutazione</option>
                                <option value="1">1 - Molto Povera</option>
                                <option value="2">2 - Povera</option>
                                <option value="3">3 - Media</option>
                                <option value="4">4 - Buona</option>
                                <option value="5">5 - Eccellente</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="section">Sezione:</label>
                            <select id="section" class="form-select" name="section" required>
                                <option value="0">Benessere</option>
                                <option value="1">Sport</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="course" class="form-label">Elenco Corsi</label>
                            <select id="course" name="course" class="form-select" required>
                                <option value="">Caricamento corsi...</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">Commento:</label>
                            <textarea id="comment" name="comment" class="form-control" rows="5" placeholder="Scrivi il tuo commento qui..." required></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-primary btn-lg">Invia Recensione</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php generateFooter(); ?>
<script src="js_reviews.js" defer></script>
</body>
</html>
