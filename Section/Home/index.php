<?php
    require_once("../../View/navbar.php");
    require_once("../../View/footer.php");
    require_once("../Courses/functionCourses.php");
    require_once("../Events/functionEvents.php");
    require_once("../../View/includeAll_lib.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="../../style/style_footer.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_nav.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_cards.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_carousel.css">
    <link rel="stylesheet" type="text/css" href="../Reviews/showReview/style_reviews.css">
    <title>Home</title>
    <?php includeStyles(); ?>
</head>
<body>

<?php navbar(); ?>

<div class="container-fluid">
    <div class="justify-content-center">
        <div class="carousel-container">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-bs-pause="hover">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/Images/logo.png" class="d-block w-100" alt="Slide 1">
                        <div class="carousel-caption d-none d-md-block">

                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="/Images/logo.png" class="d-block w-100" alt="Slide 2">
                        <div class="carousel-caption d-none d-md-block">

                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="/Images/logo.png" class="d-block w-100" alt="Slide 3">
                        <div class="carousel-caption d-none d-md-block">

                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="/Images/logo.png" class="d-block w-100" alt="Slide 4">
                        <div class="carousel-caption d-none d-md-block">
                            <!-- todo add description of various image -->
                        </div>
                    </div>
                </div>
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="3"
                            aria-label="Slide 4"></button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid ">
    <div class="row pardiv">
        <div class="col-md-11">
            <div class="testo">
                <h2>LA NOSTRA PALESTRA</h2>
                <p>
                    AGGIUNGERE DESCRZIONE
                </p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid corsi">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10 col-xl-8 text-center">
            <h3 class="fw-bold mb-4">Corsi</h3>
            <p class="mb-4 pb-2 mb-md-5 pb-md-0">
                I nostri corsi
                Di seguito i corsi che la nostra scuola propone
            </p>
        </div>
    </div>

    <div class="row">
        <?php
        showCourses(0);
        showCourses(1);
        ?>
    </div>
</div>

<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10 col-xl-8 text-center">
            <h3 class="fw-bold mb-4">Eventi</h3>
            <p class="mb-4 pb-2 mb-md-5 pb-md-0">I nostri eventi</p>
        </div>
    </div>
    <div class="row">
        <?php showEvents() ?>
    </div>
</div>

<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10 col-xl-8 text-center">
            <h3 class="fw-bold mb-4">Testimonianze</h3>
            <p class="mb-4 pb-2 mb-md-5 pb-md-0">I nostri clienti ci raccontano la loro esperienza</p>
        </div>
    </div>
    <div id="reviews-container">

    </div>
</div>

<script src="../Reviews/showReview/js_showAllReviewClient.js" defer></script>
<?php generateFooter(); ?>
</body>
</html>
