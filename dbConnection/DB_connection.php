<?php
require_once ("config.php");
function DBConnect()
{
    try {
        $dsn = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';port=' . DB_PORT;
        $conn = new PDO($dsn, DB_USER, DB_PASSWORD, NULL);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo $e->getMessage();
        echo "Connection fail";
        exit();
    }
    return $conn;

}
?>
