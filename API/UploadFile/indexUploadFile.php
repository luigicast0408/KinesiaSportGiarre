<?php
require_once("../../View/includeAll_lib.php");
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design -->
    <title>Upload File</title>
    <link type="text/css" href="style.css">
    <?php includeStyles() ?>
</head>
<body>
<div class="container">
    <div class="container form-container">
        <h3>Upload File for Client</h3>

        <form id="upload-form" enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" id="client_id" name="client_id" value="">
                <label for="file" class="form-label">Upload File:</label>
                <input type="file" id="file" name="file" class="form-control" required>
            </div>

            <input type="hidden" id="client_id" name="client_id" value="">

            <div class="form-group">
                <label for="date_start" class="form-label">Date Start:</label>
                <input type="date" name="date_start" id="date_start" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="date_end" class="form-label">Date End:</label>
                <input type="date" name="date_end" id="date_end" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description:</label>
                <input type="text" name="des" id="description" class="form-control" required>
            </div>

            <div class="form-group">
                <button type="button" id="upload-btn" class="btn btn-primary submit-btn">Upload</button>
            </div>
        </form>
    </div>

</div>
<script src="js_uploadFile.js" defer></script>
</body>
</html>
