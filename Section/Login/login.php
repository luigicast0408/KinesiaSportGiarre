<?php
require_once ("../../dbConnection/DB_connection.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])){
        $username = $_POST['username'];
        $passwordIn = $_POST['password'];
    }
    $query= "SELECT  client_id,  name, surname, username, password FROM users WHERE username = '$username'";
    $connection= DBConnect();
    $stmt = $connection->prepare($query);
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    $row = $stmt->fetch();
    if ($stmt->rowCount() == 1  && password_verify($row['password'], $passwordIn)){
        $_SESSION['client_id'] = $row['client_id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['surname'] = $row['surname'];
        $_SESSION['username'] = $row['username'];

        if ($row['isAdmin'] == 1) {
            header("Location: ../Admin/indexAdmin.php");
        }else{
            header("Location: ../Home/index.php");
        }
        exit();
    } else{
        $connection = null;
    }
}
?>
