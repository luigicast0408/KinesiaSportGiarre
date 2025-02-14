<?php
require_once ("../../dbConnection/DB_connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $passwordIn = $_POST['password'];

    try {
        $connection = DBConnect();
        $query = "SELECT client_id, first_name, last_name, username, password, is_admin FROM Clients WHERE username = :username";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($passwordIn, $row['password'])) {
            $_SESSION['client_id'] = $row['client_id'];
            $_SESSION['name'] = $row['first_name'];
            $_SESSION['surname'] = $row['last_name'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['isAdmin'] = $row['is_admin'];

            if ($row['is_admin'] == 1) {
                header("Location: ../Admin/indexAdmin.php");
            } else {
                header("Location: ../Home/index.php");
            }
            exit();
        } else {
            echo " Username o password non validi.";
        }
    } catch (Exception $e) {
        echo "Errore durante il login: " . $e->getMessage();
    }
}
?>
