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
    <h3>Delete Lesson Schedule Instructor</h3>
</div>
<div class="container">
    <div class="card">
        <div class="card-body">
                <div class="mb-3">
                    <label for="instructors" class="form-label">Select Instructor:</label>
                    <select id="instructors" name="instructor" class="form-select" required>
                        <option value="">Loading instructors...</option>
                    </select>
                </div>
                <div class="mb-3">
                   <div class="schedule-instructors-container" id="schedule-instructors-container">

                   </div>
                </div>
        </div>
    </div>
    <div id="message-container" class="mt-3"></div
</div>
<script src="js_deleteSchedulesInstructors.js" defer></script>
<script src="../addSchedulesInstructors/js_showInstructors.js" defer></script>
</body>
</html>