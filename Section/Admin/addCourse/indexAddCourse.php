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
    <?php includeStyles(); ?>
    <title>Add New Course</title>
</head>
<body>
<?php renderAdminNavbar(); ?>

<div class="container-fluid">
    <div class="header">
        <h3>Add New Course</h3>
    </div>
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <div class="card-body">
            <form id="add-course-form" method="POST" action="addCourse.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="discipline">Discipline:</label>
                    <input type="text" id="discipline" name="discipline" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" id="description" name="description" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="section">Section:</label>
                    <select id="section" name="section" class="form-control" required>
                        <option value="-1">Select Section</option>
                        <option value="0">Benessere</option>
                        <option value="1">Sport</option>
                    </select>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary" style="margin-top: 10px">Add Course</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
