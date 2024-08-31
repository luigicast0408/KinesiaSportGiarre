<?php
require_once("../../View/navbar.php");
require_once("../../View/footer.php");
require_once("../../View/includeAll_lib.php");
require_once("functionInstructor.php")

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Insegnanti</title>
    <link rel="stylesheet" type="text/css" href="../../style/style_footer.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_nav.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_header.css">
    <?php includeStyles() ?>
</head>
<body>
<?php navbar(); ?>

<div class="header">
    <h3>Insegnanti</h3>
</div>

<div class="container-fluid">
    <div class="row" style="padding-top: 2%">
        <?php showInstructor() ?>
    </div>
</div>

<?php generateFooter(); ?>
</body>
</html>
