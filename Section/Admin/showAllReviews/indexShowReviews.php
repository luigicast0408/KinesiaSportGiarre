<?php
require_once ("../../../View/includeAll_lib.php");
require_once ("../../../View/navbarAdmin.php");
require_once ("../../../View/footerAdmin.php");
require_once ("../../../View/headerAdmin.php");
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
<?php
echo renderAdminNavbar();
echo renderAdminHeader("Gestione Recenzioni");
?>

<div class="container-fluid">
    <div id="review-container">
    </div>
</div>
<?php renderAdminFooter() ?>
<script src="js_showReviews.js" defer></script>
</body>
</html>
