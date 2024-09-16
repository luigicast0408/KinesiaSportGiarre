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
    <title>Calendario Lezioni</title>
</head>
<body>
<?php navbar()?>

<div id="calendar"></div>

<div id="bookingModal" class="modal">
    <div class="modal-content">
        <span class="close" aria-label="Close modal">&times;</span>
        <h2 class="modal-title">Book a Lesson</h2>
        <form id="bookingForm">
            <input type="hidden" id="client_id" name="client_id" value="<?php echo $_SESSION['client_id']?>">
            <input type="hidden" id="lesson_id" name="id_lesson">
            <input type="hidden" id="lesson" name="lesson">
            <input type="hidden" id="start" name="start">
            <button type="submit" class="btn btn-primary" id="submit" name="submit">Submit Booking</button>
        </form>
    </div>
</div>

<?php generateFooter(); ?>

<script src="js_reservationLesson.js" defer></script>
</body>
</html>
