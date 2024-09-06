<?php
require_once ("../../../View/navbarAdmin.php");
require_once ("../../../View/includeAll_lib.php");
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../../style/style_footer.css">
    <link rel="stylesheet" type="text/css" href="../../../style/style_nav.css">
    <link rel="stylesheet" type="text/css" href="../../../style/style_cards.css">
    <link rel="stylesheet" type="text/css" href="../../../style/style_header.css">
    <title>ADMIN </title>
    <?php includeStyles() ?>
</head>
<body>
<?php renderAdminNavbar() ?>
    <div class="header">
        <h3>SHOW ALL USERS</h3>
    </div>

<div class="container-fluid">
    <div class="clients-container">

    </div>
</div>


<script src="js_showUsers.js" defer></script>
</body>
</html>


