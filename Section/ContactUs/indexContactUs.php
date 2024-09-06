<?php
require_once("../../View/navbar.php");
require_once("../../View/footer.php");
require_once("../../View/includeAll_lib.php");
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Contatti</title>
    <link rel="stylesheet" type="text/css" href="../../style/style_footer.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_nav.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_header.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_cards.css">
    <?php includeStyles() ?>
    <style>
        .contact-info {
            margin-top: 20px;
        }
        .map-container {
            margin-top: 20px;
        }
        .form-control {
            border-radius: 20px;
        }
        .btn-custom {
            border-radius: 20px;
            width: 100%;
        }
        .card {
            background-color: #e3f2fd; /* Light blue background color */
        }
    </style>
</head>
<body>
<?php navbar(); ?>

<div class="header">
    <h3>Contatti</h3>
</div>

<div class="container-fluid">
    <div class="row" style="padding-top: 2%">
        <div class="col-md-6">
            <div class="card shadow-2-strong card-registration" style="border-radius: 25px">
                <div class="card-title">
                    <h3>Contattaci</h3>
                </div>
                <div class="card-body">
                    <form action="#" method="POST"> <!--  todo: add php file (send mail) -->
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Oggetto</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Messaggio</label>
                            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-custom" style="margin-top: 3%">Invia</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6 contact-info">
            <h4>Informazioni di Contatto</h4>
            <p><strong>Telefono:</strong> +39 123 456 7890</p>
            <p><strong>Email:</strong> info@example.com</p>
            <p><strong>Indirizzo:</strong> Via Roma, 123, 00100 Roma, Italia</p>
        </div>
    </div>

    <div class="map-container">
        <h4>La Nostra Posizione</h4>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3121.5895390288697!2d12.496365115396109!3d41.90278317936548!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x132f60674d7e8c6b%3A0xa54e5a3eec44c1ed!2sVia%20Roma%2C%20123%2C%2000100%20Roma%20RM%2C%20Italy!5e0!3m2!1sen!2sus!4v1633970883492!5m2!1sen!2sus"
            width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</div>

<?php generateFooter(); ?>
</body>
</html>
