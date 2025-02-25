<?php
require_once ("../../View/navbar.php");
require_once ("../../View/footer.php");
require_once ("../../View/includeAll_lib.php");

if (!isset($_SESSION['client_id'])) {
    header("Location: /Section/Login/indexLogin.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../style/style_footer.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_nav.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_header.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <?php includeStyles(); ?>
    <title>Calendario Stage</title>
</head>
<body>
<?php navbar()?>

<label for="stage">Seleziona uno Stage:</label>
<input type="hidden" id="stage_id" name="stage_id">
<input type="hidden" id="client_id" name="client_id" value="<?php echo $_SESSION['client_id'] ?>">

<div id="calendar"></div>

<div id="bookingModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h2 id="modalTitle"></h2>
        <p id="modalBody"></p>
        <button id="bookStage">Prenota Stage</button>
    </div>
</div>

<?php generateFooter(); ?>

<script src="js_stage.js" defer></script>
</body>
</html>
