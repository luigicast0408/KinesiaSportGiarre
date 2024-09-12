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
    <title>Add Lesson</title>
</head>
<body>
<?php renderAdminNavbar(); ?>

<div class="header">
    <h3>Add Lesson</h3>
</div>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <form id="addLessonForm" class="mb-4">
                <div class="mb-3">
                    <label for="section" class="form-label">Sezione:</label>
                    <select id="section" class="form-select" name="section" required>
                        <option value="0">Benessere</option>
                        <option value="1">Sport</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="course" class="form-label">Elenco Corsi</label>
                    <select id="course" name="course" class="form-select" required>
                        <option value="">Caricamento corsi...</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="lesson_date" class="form-label">Lesson Date and Time:</label>
                    <input type="datetime-local" id="lesson_date" name="lesson_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="duration" class="form-label">Duration (minutes):</label>
                    <input type="number" id="duration" name="duration" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Add Lesson</button>
            </form>
        </div>
    </div>

    <div id='calendar'></div>
</div>
<script src="js_addLessons.js" defer></script>
</body>
</html>
