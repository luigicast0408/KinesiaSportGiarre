<?php

require_once ("../dbConnection/config.php");

class Api {
    private $pdo;

    public function __construct($host, $dbName, $user, $password, $port) {
        $this->connect($host, $dbName, $user, $password, $port);
    }

    private function connect($host, $dbName, $user, $password, $port) {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbName;port=$port", $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->handleError(500, "Error in the server: " . $e->getMessage());
        }
    }

    public function handleRequest(): void {
        if (isset($_GET['request']) && $_GET['request'] === 'courses' && isset($_GET['section'])) {
            $section = (int)$_GET['section'];
            error_log("Request received: section = $section");
            $this->getCourses($section);
        } else {
            $this->handleError(400, "Invalid request");
        }
    }

    private function getCourses($section) {
        $stmt = $this->pdo->prepare("SELECT discipline, course_description, image_link FROM Courses WHERE section = :section");
        $stmt->bindParam(":section", $section, PDO::PARAM_INT);
        $stmt->execute();
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($courses) {
            echo json_encode(["status" => 200, "data" => $courses]);
        } else {
            $this->handleError(404, "No courses found for this section.");
        }
    }

    private function handleError($status, $message) {
        echo json_encode(["status" => $status, "message" => $message]);
        exit;
    }
}

$api = new Api(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD, DB_PORT);
$api->handleRequest();
