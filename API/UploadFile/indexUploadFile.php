<?php
require_once ("../../View/includeAll_lib.php");
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php includeStyles();?>
    <title>Upload File for Client</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="form-container">
        <h3>Upload File for Client</h3>
        <form id="upload-form" enctype="multipart/form-data">
            <input type="hidden" id="client_id" name="client_id">
            <label for="file">Select File to Upload</label>
            <input type="file" id="file" name="file" required>

            <label for="date_start">Date Start</label>
            <input type="date" name="date_start" id="date_start" required>

            <label for="date_end">Date End</label>
            <input type="date" name="date_end" id="date_end" required>

            <label for="description">Description</label>
            <input type="text" name="description" id="description" required>

            <button type="button" id="upload-btn">Upload File</button>
            <button type="button" id="home-btn">Home </button>
        </form>
    </div>
</div>
<script src="js_uploadFile.js" defer></script>
</body>
</html>
