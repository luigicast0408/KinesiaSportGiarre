<?php
require_once("../../View/navbar.php");
require_once("../../View/footer.php");
require_once("../../View/includeAll_lib.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../style/style_footer.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_nav.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_cards.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_header.css">
    <title>Galleriay</title>
    <?php includeStyles() ?>
</head>
<body>

<?php navbar() ?>

<div class="header">
    <h3>Galleria</h3>
</div>

<div class="container-fluid">
    <div id="eventsContainer" class="row">

    </div>
</div>

<script src="js_gallery.js" defer></script>
<?php generateFooter() ?>
</body>
</html>
