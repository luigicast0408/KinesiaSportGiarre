<?php
session_start();
session_destroy();

unset($_SESSION['client_id']);
unset($_SESSION['name']);
unset($_SESSION['surname']);
unset($_SESSION['username']);
unset($_SESSION['isAdmin']);
unset($_SESSION);
header("Location: ../Home/index.php");
exit();
?>