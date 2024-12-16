<?php
require_once ("../../../View/includeAll_lib.php");
require_once ("../../../View/navbarAdmin.php");
require_once ("../../../View/headerAdmin.php");
require_once ("../../../View/footerAdmin.php");
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
    <?php includeStyles(); ?>
    <title>Add New Course</title>
</head>
<body>
<?php
echo renderAdminNavbar();
echo renderAdminHeader("Aggiungi un nuovo Corso");
?>

<div class="container-fluid">
    <div class="card shadow-lg p-4" style="max-width: 600px; margin: 20px auto; border-radius: 10px; border: none;">
        <div class="card-body">
            <form id="add-course-form" method="POST" action="addCourse.php" enctype="multipart/form-data">
                <div class="form-group mb-3">
                    <label for="discipline" class="form-label">Disciplina:</label>
                    <input type="text" id="discipline" name="discipline" class="form-control shadow-sm" placeholder="Enter the discipline" required>
                </div>
                <div class="form-group mb-3">
                    <label for="description" class="form-label">Descrizione:</label>
                    <textarea id="description" name="description" class="form-control shadow-sm" rows="3" placeholder="Enter a brief description" required></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="section" class="form-label">Section:</label>
                    <select id="section" name="section" class="form-select shadow-sm" required>
                        <option value="-1" disabled selected>Selziona Sezione</option>
                        <option value="0">Benessere</option>
                        <option value="1">Sport</option>
                    </select>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary shadow-sm px-4 py-2" style="border-radius: 5px;">Aggiungi Corso</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php echo  renderAdminFooter() ?>

</body>
</html>
