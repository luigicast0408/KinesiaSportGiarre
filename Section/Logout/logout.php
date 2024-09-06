<?php
session_start();
session_destroy();
unset($_SESSION['Cognome']);//svota l'array associativo con chiave "Cognome"
unset($_SESSION['Nome']);
header("Location: ../Home/index.php");
exit();
?>