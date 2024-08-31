<?php
require_once ("../../View/footer.php");
require_once ("../../View/navbar.php");
require_once ("../../View/includeAll_lib.php");
require_once("functionGallery.php");
require_once("../../dbConnection/DB_connection.php");
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Galleria</title>
    <link rel="stylesheet" type="text/css" href="../../style/style_footer.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_nav.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_cards.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_header.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <?php includeStyles() ?>
</head>
<body>
<?php navbar() ?>
<div class="header">
    <h3>Gelleria</h3>
</div>

<div class="d-flex justify-content-center">
    <div class="btn-group" role="group">
        <button type="button" class="btn btn-primary mx-3 btn-lg">Left</button>
        <button type="button" class="btn btn-primary mx-3 btn-lg">Middle</button>
        <button type="button" class="btn btn-primary mx-3 btn-lg">Right</button>
    </div>
</div>


<div class="container-fluid">
    <div class="row" style="padding-top: 2%">
        <?php
            $conn=DBConnect();
            $sql="SELECT * FROM Events";
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            $events=$stmt->fetchAll();
            foreach ($events as $event) {
                $ev=array($event['event_id']);
                displayGallery($ev);
            }
        ?>
    </div>
</div>
<?php generateFooter() ?>
</body>
</html>
