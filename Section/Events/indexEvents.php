<?php
require_once("functionEvents.php");
require_once("../../View/navbar.php");
require_once("../../View/footer.php");
require_once("../../View/includeAll_lib.php");
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Eventi</title>
    <link rel="stylesheet" type="text/css" href="../../style/style_footer.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_nav.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_header.css">
    <?php includeStyles() ?>
</head>
<body>
<?php navbar(); ?>

<div class="header">
    <h3>Eventi</h3>
</div>

<div class="container-fluid">
    <div class="row" style="padding-top: 2%">
        <?php showEvents(); ?>
    </div>
</div>

<?php generateFooter(); ?>
</body>
</html>
