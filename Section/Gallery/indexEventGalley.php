<?php
require_once ("../../View/footer.php");
require_once ("../../View/navbar.php");
require_once ("../../View/includeAll_lib.php");
require_once("../../dbConnection/DB_connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_footer.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_nav.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_cards.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_header.css">
    <link rel="stylesheet" type="text/css" href="images.css">
    <?php includeStyles() ?>
    <title>Gallery</title>
</head>
<body>
<?php navbar() ?>

<div class="header">
    <h3>Gallery</h3>
</div>

<div id="imagesContainer" class="image-grid container-fluid">
    <!-- Images will be populated here -->
</div>

<div class="modal fade" id="imageCarousel" tabindex="-1" role="dialog" aria-labelledby="carouselLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" id="carouselImagesContainer"></div>
                    <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js_eventGallery.js" defer></script>
<?php generateFooter() ?>
</body>
</html>
