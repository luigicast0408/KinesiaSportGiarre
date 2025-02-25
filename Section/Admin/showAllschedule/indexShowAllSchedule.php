<?php
session_start();
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
echo renderAdminHeader("Visualizza Orari");
?>
<div class="container-fluid">
    <input type="hidden" value="<?=$_SESSION['client_id']?>" id="client_id" name="client_id">
    <div id="schedule-container">

    </div>
</div>
<script src="js_showAllSchedule.js" defer> </script>
<?php renderAdminFooter() ?>
