<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Corsi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="header">
        <h1>Corsi</h1>
    </div>

    <div class="container-fluid">
        <div class="row" style="padding-top: 2%">
            <?php showCourses(); ?>
        </div>
    </div>
</body>
</html>
