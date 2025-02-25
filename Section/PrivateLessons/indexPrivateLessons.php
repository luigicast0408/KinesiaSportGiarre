<?php
require_once("../../View/navbar.php");
require_once("../../View/footer.php");
require_once("../../View/includeAll_lib.php");
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Contatti</title>
    <link rel="stylesheet" type="text/css" href="../../style/style_footer.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_nav.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_header.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_cards.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <?php includeStyles() ?>
    <style>

        select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        #calendar {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<?php navbar(); ?>

<div class="container-fluid">
    <div class="header">
        <h3>📅 Prenotazione Lezioni</h3>
    </div>

    <div class="instructor-select-container">
        <label for="instructor" class="form-label"><strong>🔍 Seleziona un Istruttore:</strong></label>
        <select id="instructor" class="form-select">
            <option value="">-- Seleziona un Istruttore --</option>
        </select>
    </div>

    <div class="section-select-container">
        <label for="section" class="form-label"><strong>🔍 Seleziona una Sezione:</strong></label>
        <select id="section" class="form-select">
            <option value="0">Benessere</option>
            <option value="1">Sport</option>
        </select>
    </div>

    <div class="course-select-container">
        <label for="course" class="form-label"><strong>🔍 Seleziona un Corso:</strong></label>
        <select id="course" class="form-select">
            <option value="">-- Seleziona un Corso --</option>
        </select>
    </div>

    <div id="calendar"></div>
</div>

<div id="bookingModal" class="modal">
    <div class="modal-content">
        <span id="closeModal" class="close">&times;</span>
        <h2 id="modalTitle"></h2>
        <div id="modalBody"></div>
        <button id="bookLesson">Prenota</button>
    </div>
</div>

<script src="js_privateLessons.js" defer></script>

<?php generateFooter(); ?>
</body>
</html>
