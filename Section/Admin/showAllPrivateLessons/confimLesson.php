<?php
require_once("../../../dbConnection/DB_connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    if (isset($_POST['success'])){
        $connection = DBConnect();
        $id = $_POST["private-lesson_id"];
        $query = "UPDATE PrivateLessons SET status = 1 WHERE private_lesson_id = :id";
        $stm = $connection->prepare($query);
        $stm->bindParam(":id", $id);
        $stm->execute();
        $connection = null;
        header("Location: /Section/Admin/showAllPrivateLessons/indexShowAllPrivateLessons.php");
    } elseif (isset($_POST['delete'])) {
        $connection = DBConnect();
        $id = $_POST["private-lesson_id"];
        $query = "DELETE FROM PrivateLessons WHERE private_lesson_id = :id";
        $stm = $connection->prepare($query);
        $stm->bindParam(":id", $id);
        $stm->execute();
        $connection = null;
        header("Location: /Section/Admin/showAllPrivateLessons/indexShowAllPrivateLessons.php");
    }
}