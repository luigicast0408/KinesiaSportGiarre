<?php
require_once ("../../View/footer.php");
require_once ("../../View/navbar.php");
require_once ("../../View/includeAll_lib.php");
require_once("../../dbConnection/DB_connection.php");
require_once ("functionCourses.php");
require_once ("functionCourses.php");

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../style/style_footer.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_nav.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_cards.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_header.css">
    <title>Corsi</title>
    <?php includeStyles() ?>
</head>
<body>
<?php navbar() ?>
<div class="header">
    <h3>Corsi</h3>
</div>
<div class="container-fluid" style="margin-top: 2%">
    <div class="d-flex justify-content-center" style="margin-bottom: 1%">
        <div class="btn-group align-content-center" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-primary" id="all">ALL</button>
            <button type="button" class="btn btn-primary" id="load-section-0"> Benessere </button>
            <button type="button" class="btn btn-primary" id="load-section-1"> Sport </button>
        </div>
    </div>

    <div class="courses-container" id="courses-container">
        <?php
            showCourses(0);
            showCourses(1);
        ?>
    </div>

    <?php generateFooter() ?>
</div>
<script src="js_courses.js" defer></script>
</body>
</html>
