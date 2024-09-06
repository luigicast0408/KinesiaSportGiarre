<?php
require_once("../../View/navbar.php");
require_once("../../View/footer.php");
require_once("../../View/includeAll_lib.php");
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Schede di allenamento</title>
    <link rel="stylesheet" type="text/css" href="../../style/style_footer.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_nav.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_header.css">
    <?php includeStyles() ?>
</head>
<body>
<?php navbar();
$clientId = isset($_SESSION['client_id']) ? $_SESSION['client_id'] : null;
$userFirstName = isset($_SESSION['name']) ? $_SESSION['name'] : 'Utente';
$userLastName = isset($_SESSION['surname']) ? $_SESSION['surname'] : '';
?>

<div class="header">
    <h3>Schede allenamento</h3>
    <p>Benvenuto/a, <?php echo $userFirstName . ' ' . $userLastName; ?>!</p>
</div>

<div class="container-fluid">
    <div class="trainingPlans"></div>
</div>

<?php generateFooter(); ?>

<script>
    const clientId = <?php echo json_encode($clientId); ?>;
</script>

<script src="js_trainingPlans.js" defer></script>
</body>
</html>
