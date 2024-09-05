<?php
require_once ("../../dbConnection/DB_connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $passwordIn = $_POST['password'];

        $query = "SELECT client_id, first_name, last_name, username, password, isAdmin FROM KinesiaDB.Clients WHERE username = :username";

        $connection = DBConnect();
        $stmt = $connection->prepare($query);
        $stmt->bindValue(':username', $username);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC); // Use associative array for better readability

        if ($stmt->rowCount() == 1 && password_verify($passwordIn, $row['password'])) {
            $_SESSION['client_id'] = $row['client_id'];
            $_SESSION['name'] = $row['first_name']; // Changed 'name' to 'first_name'
            $_SESSION['surname'] = $row['last_name']; // Changed 'surname' to 'last_name'
            $_SESSION['username'] = $row['username'];

            if ($row['isAdmin'] == 1) {
                header("Location: ../Admin/indexAdmin.php");
            } else {
                header("Location: ../Home/index.php");
            }
            exit();
        } else {
            echo "Invalid username or password.";
        }
    }
}
?>
