<?php
require_once ("../../../View/includeAll_lib.php");
require_once ("../../../View/navbarAdmin.php");
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../../style/style_footer.css">
    <link rel="stylesheet" type="text/css" href="../../../style/style_nav.css">
    <link rel="stylesheet" type="text/css" href="../../../style/style_cards.css">
    <link rel="stylesheet" type="text/css" href="../../../style/style_header.css">
    <title>Gestione Recenzioni - Admin</title>
    <?php includeStyles() ?>
</head>
<body>
<?php renderAdminNavbar() ?>

<div class="header">
    <h3>Gestione Recenzioni</h3>
</div>

<div class="container-fluid">
    <div id="review-container">
    </div>
</div>
<script src="js_showReviews.js" defer></script>
</body>
</html>
