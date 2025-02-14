<?php
require_once("../../dbConnection/config.php");
require_once("../../dbConnection/DB_connection.php");

$connection = DBConnect(); // Connessione al DB

if (isset($_POST['home'])) {
    header("Location: ../Home/index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica che il campo password sia presente
    if (empty($_POST['password'])) {
        die("Errore: Il campo password è obbligatorio.");
    }

    // Pulizia input
    $first_name = trim(htmlspecialchars($_POST['name'] ?? ''));
    $last_name = trim(htmlspecialchars($_POST['surname'] ?? ''));
    $phone_number = trim(htmlspecialchars($_POST['phoneNumber'] ?? ''));
    $email = trim(htmlspecialchars($_POST['email'] ?? ''));
    $username = trim(htmlspecialchars($_POST['username'] ?? ''));
    $password = trim($_POST['password']);

    // Controlla che tutti i campi siano valorizzati
    if (empty($first_name) || empty($last_name) || empty($phone_number) || empty($email) || empty($username) || empty($password)) {
        die("Errore: Tutti i campi devono essere compilati.");
    }

    // Hash della password
    $pass_hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Controllo se username o email esistono già
        $checkQuery = "SELECT COUNT(*) FROM Clients WHERE username = :username OR email = :email";
        $stmt = $connection->prepare($checkQuery);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $exists = $stmt->fetchColumn();

        if ($exists > 0) {
            die("Errore: Username o Email già esistenti!");
        }

        // Query di inserimento
        $insertQuery = "INSERT INTO Clients (first_name, last_name, phone_number, email, username, password, is_admin, role, description) 
                        VALUES (:first_name, :last_name, :phone_number, :email, :username, :password, 0, 0, '')";
        $stmt = $connection->prepare($insertQuery);
        $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $pass_hash, PDO::PARAM_STR); // Usa la password hashata
        $stmt->execute();

        header("Location: ../Login/indexLogin.php");
        exit;
    } catch (Exception $e) {
        die("Errore durante la registrazione: " . $e->getMessage());
    }
}
?>
