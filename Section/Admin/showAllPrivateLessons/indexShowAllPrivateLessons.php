<?php
require_once("../../../View/navbarAdmin.php");
require_once("../../../View/includeAll_lib.php");
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../../style/style_footer.css">
    <link rel="stylesheet" type="text/css" href="../../../style/style_nav.css">
    <link rel="stylesheet" type="text/css" href="../../../style/style_cards.css">
    <link rel="stylesheet" type="text/css" href="../../../style/style_header.css">
    <title>Gestione Corsi - Admin</title>
    <?php includeStyles() ?>
</head>
<body>
<?php renderAdminNavbar() ?>

<div class="header">
    <h3>Gestione Lezione private</h3>
</div>

<div class="container-fluid">
    <div class="chose-ins">
        <h4>Scegli un insegnante:</h4>
        <label for="instructors"></label><select id="instructors" name="instructor" class="form-select" required>
            <option value="">Caricamento insegnanti...</option>
        </select>
        <input type="hidden" id="instructor_id" name="instructor_id">
    </div>
    <div id="private-lessons-container">

    </div>
</div>


<script src="/Section/Admin/addSchedulesInstructors/js_showInstructors.js" defer></script>
<script src="js_showAllPrivateLessons.js" defer></script>
</body>
</html>
