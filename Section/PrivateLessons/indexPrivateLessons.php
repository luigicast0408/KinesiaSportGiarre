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
    <title>Calendario  Trattamenti</title>
</head>
<body>
<?php navbar()?>
<div class="header">
    <h3>Calendario Trattamenti</h3>
</div>

<div class="container">
    <p>Con quale instruttore vuoi prenotare la lezione privata</p>
    <label for="instructors"></label><select id="instructors" name="instructor" class="form-select" required>
        <option value="">Caricamento insegnanti...</option>
    </select>
</div>

<div class="container">
 <div class="calendar" id="calendar"></div>

</div>

<div id="bookingModal" class="modal">
    <div class="modal-content">
        <span class="close" aria-label="Close modal">&times;</span>
        <h2 class="modal-title">Prenotazione</h2>
        <div id="modalContent"></div>
        <form id="bookingForm">
            <input type="hidden" name="start_time" id="start_time">
            <input type="hidden" name="end_time" id="end_time">
            <input type="hidden" name="day_of_week" id="day_of_week">

            <input type="hidden" name="instructor_id" id="instructor_id">
            <input type="hidden" name="client_id" id="client_id" value="<?php echo $_SESSION['client_id'] ?>">
            <input type="hidden" name="data" id="data">
            <input type="hidden" name="instructor_schedule_id" id="instructor_schedule_id">

            <button type="submit" class="btn btn-primary" id="submit" name="submit">Submit Booking</button>
        </form>
    </div>
</div>

<div id="errorMessage" style="color: red; display: none;"></div>
<div id="successMessage" style="color: green; display: none;"></div>

<?php generateFooter(); ?>

<script src="js_privateLessons.js" defer></script>
<script src="../Admin/addSchedulesInstructors/js_showInstructors.js" defer></script>
</body>
</html>
