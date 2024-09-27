<?php
require_once("../../../View/includeAll_lib.php");
require_once("../../../View/navbarAdmin.php");
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
    <title>Aggiungi Orari Disponibili</title>
</head>
<body>
<?php renderAdminNavbar(); ?>

<div class="header">
    <h3>Aggiungi Orari Disponibili per Insegnante</h3>
</div>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <form method="POST" id="addHoursForm" class="mb-4" action="schedulesInstructor.php">
                <div class="mb-3">
                    <label for="day" class="form-label">Giorno:</label>
                    <select id="day" name="day" class="form-select" required>
                        <option value="1">Lunedì</option>
                        <option value="2">Martedì</option>
                        <option value="3">Mercoledì</option>
                        <option value="4">Giovedì</option>
                        <option value="5">Venerdì</option>
                        <option value="6">Sabato</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="time" class="form-label">Orario Inizio:</label>
                    <input type="time" id="time" name="time" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="duration" class="form-label">Durata (minuti):</label>
                    <input type="number" id="duration" name="duration" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="instructors" class="form-label">Insegnante:</label>
                    <select id="instructors" name="instructor_id" class="form-select" required>
                        <option value="">Caricamento insegnanti...</option>
                    </select>
                </div>

                <div class="mb-3">
                    <input type="hidden" name="instructor_id" id="instructor_id" value="">
                    <button type="submit" class="btn btn-primary">Aggiungi Orario</button>
                </div>
            </form>

            <h5>Orari Aggiunti</h5>
            <div id="schedule-instructors-container">

            </div>
        </div>
    </div>
</div>
<script src="js_showInstructors.js" defer></script>
<script src="js_addSchedulesInstructor.js" defer></script>
</body>
</html>