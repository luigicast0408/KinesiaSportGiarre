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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../style/style_footer.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_nav.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_header.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_cards.css">
    <?php includeStyles() ?>
</head>
<body>
<?php navbar(); ?>

<div class="header">
    <h3>Contatti</h3>
</div>

<div class="container-fluid">
    <div class="row" style="padding-top: 2%">
        <div class="col-lg-6 col-md-12">
            <div class="card shadow-2-strong card-registration" style="border-radius: 25px">
                <div class="card-title">
                    <h3>Contattaci</h3>
                </div>
                <div class="card-body">
                    <form action="#" method="POST" id="contactForm"> <!--  todo: add php file (send mail) -->
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Inserisci il tuo nome" required aria-label="Nome">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Inserisci la tua email" required aria-label="Email">
                        </div>
                        <div class="form-group">
                            <label for="subject">Oggetto</label>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Oggetto del messaggio" required aria-label="Oggetto">
                        </div>
                        <div class="form-group">
                            <label for="message">Messaggio</label>
                            <textarea class="form-control" id="message" name="message" rows="4" placeholder="Scrivi il tuo messaggio" required aria-label="Messaggio"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-custom" style="margin-top: 3%">Invia</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 contact-info">
            <h4>Informazioni di Contatto</h4>
            <ul class="list-unstyled">
                <li>
                    <p><i class="fas fa-phone" style="color: black;"></i> <strong>Telefono:</strong>
                        <a href="tel:+393477157985" class="footer-link">3477157985 (Vera Sorbello)</a>
                    </p>
                </li>
                <li>
                    <p><i class="fas fa-phone" style="color: black;"></i> <strong>Telefono:</strong>
                        <a href="tel:+393280850471" class="footer-link">3280850471 (Toto Parisi)</a>
                    </p>
                </li>
                <li>
                    <p><i class="fas fa-envelope" style="color: black;"></i> <strong>Email:</strong>
                        <a href="mailto:info@example.com" class="footer-link">info@example.com</a>
                    </p>
                </li>
                <li>
                    <p><i class="fas fa-map-marker-alt" style="color: black;"></i> <strong>Indirizzo:</strong>
                        <span>Via Rosolino Pilo, 32, 95014 Giarre CT</span>
                    </p>
                </li>
                <li>
                    <p><i class="fas fa-map-marker-alt" style="color: black;"></i> <strong>Indirizzo:</strong>
                        <span>Via Vincenzo Bellini, 11, 95014 Giarre CT</span>
                    </p>
                </li>
            </ul>
        </div>
    </div>

    <div class="map-container" style="padding-top: 5%">
        <h4>Le Nostre sedi</h4>
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-3">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1834.6322487519196!2d15.19025349839478!3d37.72790080000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1314070d0172c513%3A0x26caa15e0f13133c!2sASD%20Kinesia!5e1!3m2!1sit!2sit!4v1726581960268!5m2!1sit!2sit" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" aria-label="Mappa Sede ASD Kinesia"></iframe>
            </div>
            <div class="col-lg-6 col-md-12 mb-3">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1834.6484254496218!2d15.18715429839477!3d37.72724780000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x131407b44de16af7%3A0x5f23b49236164bde!2sKinesia%20Sport%20%26%20Fighting!5e1!3m2!1sit!2sit!4v1726582007255!5m2!1sit!2sit" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" aria-label="Mappa Sede Kinesia Sport & Fighting"></iframe>
            </div>
        </div>
    </div>
</div>

<?php generateFooter(); ?>
</body>
</html>
