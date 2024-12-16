<?php
require_once ("../../../View/navbarAdmin.php");
require_once ("../../../View/includeAll_lib.php");
require_once ("../../../View/headerAdmin.php");
require_once ("../../../View/footerAdmin.php");
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../../style/style_footer.css">
    <link rel="stylesheet" type="text/css" href="../../../style/style_nav.css">
    <link rel="stylesheet" type="text/css" href="../../../style/style_cards.css">
    <link rel="stylesheet" type="text/css" href="../../../style/style_header.css">
    <title>ADMIN </title>
    <?php includeStyles() ?>
</head>
<body>
<?php
echo renderAdminNavbar();
echo renderAdminHeader("Show All Users");
?>

<?php echo renderAdminFooter() ?>
<script src="js_showUsers.js" defer></script>
</body>
</html>


