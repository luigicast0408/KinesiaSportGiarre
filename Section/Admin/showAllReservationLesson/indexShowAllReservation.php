<?php
require_once ("../../../View/includeAll_lib.php");
require_once ("../../../View/navbarAdmin.php");
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../../style/style_footer.css">
    <link rel="stylesheet" type="text/css" href="../../../style/style_nav.css">
    <link rel="stylesheet" type="text/css" href="../../../style/style_cards.css">
    <link rel="stylesheet" type="text/css" href="../../../style/style_header.css">
    <?php includeStyles() ?>
    <title>Delete Lesson</title>
</head>
<body>

<?php renderAdminNavbar(); ?>
<div class="header">
    <h3>Show All Reservation  Lessons</h3>
</div>

<div class="container mt-5">
    <h3>Show All Reservation  Lessons</h3>
    <div class="card">
        <div class="card-body">
            <form id="showLessonForm" class="mb-4">
                <div class="mb-3">
                    <label for="lesson" class="form-label">Select Lesson:</label>
                    <select id="lesson" name="lesson" class="form-select" required>
                        <option value="">Caricamento lezioni...</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Select lesson</button>
            </form>
            <button id="showAllReservations" class="btn btn-primary">Show all reservations</button>
        </div>
    </div>
</div>

<div class="reservation-container-" id="reservation-container">

</div>

<script src="js_showAllReservationLesson.js"></script>
</body>
</html>
