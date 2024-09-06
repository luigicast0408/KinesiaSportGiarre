<?php
require_once("../../dbConnection/config.php");
require_once("../../dbConnection/DB_connection.php");
$connection = DBConnect(); // Funzione PDO

if (isset($_POST['home'])) {
    header("Location: ../Home/index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pass = $_POST['password'];
    $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

    if (isset($_POST['submit'])) {
        try {
            $insertValue = "INSERT INTO Clients (first_name, last_name, phone_number, email, username, password, isAdmin) VALUES (:first_name, :last_name, :phone_number, :email, :username, :password, 0)";
            $stmt = $connection->prepare($insertValue);
            $stmt->bindParam(':first_name', $_POST['name'], PDO::PARAM_STR);
            $stmt->bindParam(':last_name', $_POST['surname'], PDO::PARAM_STR);
            $stmt->bindParam(':phone_number', $_POST['phoneNumber'], PDO::PARAM_STR); // Corrected typo from phoneNumeber to phoneNumber
            $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
            $stmt->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
            $stmt->bindParam(':password', $pass_hash, PDO::PARAM_STR);
            $stmt->execute();
            header("Location: ../Login/indexLogin.php");
            exit;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
