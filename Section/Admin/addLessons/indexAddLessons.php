<?php
require_once("../../../View/includeAll_lib.php");
require_once("../../../View/navbarAdmin.php");
require_once("../../../View/headerAdmin.php");
require_once("../../../View/footerAdmin.php");

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
<?php
echo renderAdminNavbar();
echo renderAdminHeader("Aggiungi Lezione")
?>

<div class="container mt-5">
    <div class="card shadow-lg rounded border-0">
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
                    <label for="lesson_date" class="form-label">Data e ora della lezione:</label>
                    <input type="datetime-local" id="lesson_date" name="lesson_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="duration" class="form-label">Durata (minuti):</label>
                    <input type="number" id="duration" name="duration" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="instructors" class="form-label">Istruttore:</label>
                    <select id="instructors" name="instructors" class="form-select" required>
                        <option value="">Caricamento istruttori...</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="max_participants" class="form-label">Numero massimo di partecipanti:</label>
                    <input type="number" id="max_participants" name="max_participants" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Prezzo:</label>
                    <input type="number" id="price" name="price" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Location:</label>
                    <input type="text" id="location" name="location" class="form-control" required>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary btn-lg px-5 py-2 mt-3 shadow">Aggiungi Lezione</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php echo renderAdminFooter() ?>
<script src="js_addLessons.js" defer></script>
<script src="../addSchedulesInstructors/js_showInstructors.js" defer></script>
</body>
</html>
