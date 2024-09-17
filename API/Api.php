<?php

require_once("../dbConnection/config.php");

class Api
{
    private $pdo;

    public function __construct($host, $dbName, $user, $password, $port){
        $this->connect($host, $dbName, $user, $password, $port);
    }

    private function connect($host, $dbName, $user, $password, $port){
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbName;port=$port", $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->handleError(500, "Server error: " . $e->getMessage());
        }
    }

    private function handleError($status, $message){
        echo json_encode(["status" => $status, "message" => $message]);
    }

    public function handleRequest(): void{
        if (isset($_GET['request'])) {
            switch ($_GET['request']) {
                case 'courses':{
                    $section = isset($_GET['section']) ? (int)$_GET['section'] : null;
                    if ($section !== null) {
                        $this->getCourses($section);
                    } else {
                        $this->handleError(400, "Section parameter is missing.");
                    }
                    break;
                }
                case 'clients':{
                    $this->getClients();
                    break;
                }
                case 'profile':{
                    $profile = isset($_GET['profile']) ? (int)$_GET['profile'] : null;
                    if ($profile !== null) {
                        $this->getTrainingPlans($profile);
                    } else {
                        $this->handleError(400, "Profile parameter is missing.");
                    }
                    break;
                }
                case 'events':{
                    $this->getAllEvents();
                    break;
                }
                case 'eventImages':{
                    $eventIds = isset($_GET['eventIds']) ? explode(',', $_GET['eventIds']) : null;
                    if ($eventIds) {
                        $this->getImagesByEvents($eventIds);
                    } else {
                        $this->handleError(400, "Event IDs parameter is missing.");
                    }
                    break;
                }
                case 'reviews':{
                    $this->getReviews();
                    break;
                }
                case 'lessons':{
                    $this->getLessons();
                    break;
                }
                case 'usersByLessons':{
                    $lessonId = isset($_GET['lessonId']) ? (int)$_GET['lessonId'] : null;
                    if ($lessonId !== null) {
                        $this->getUsersByLessons($lessonId);
                    } else {
                        $this->handleError(400, "Lesson ID parameter is missing.");
                    }
                    break;
                }
                case 'reservations':{
                    $lessonId = isset($_GET['lessonId']) ? (int)$_GET['lessonId'] : null;
                    if ($lessonId !== null) {
                        $this->getReservations($lessonId);
                    } else {
                        $this->handleError(400, "Lesson ID parameter is missing.");
                    }
                    break;
                }
                default:{
                    $this->handleError(400, "Invalid request.");
                }
            }
        } else {
            $this->handleError(400, "Request parameter is missing.");
        }
    }

    private function getCourses($section){
        $stmt = $this->pdo->prepare("SELECT course_id, discipline, course_description, image_link FROM Courses WHERE section = :section");
        $stmt->bindParam(":section", $section, PDO::PARAM_INT);
        $stmt->execute();
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($courses) {
            echo json_encode(["status" => 200, "data" => $courses]);
        } else {
            $this->handleError(404, "No courses found for this section.");
        }
    }

    private function getClients(){
        $stmt = $this->pdo->prepare("SELECT client_id, first_name, last_name, phone_number, email FROM Clients WHERE isAdmin = 0");
        $stmt->execute();
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($clients) {
            echo json_encode(["status" => 200, "clients" => $clients]);
        } else {
            $this->handleError(404, "No clients found.");
        }
    }

    private function getTrainingPlans($clientId){
        $stmt = $this->pdo->prepare("SELECT file_name, file_path FROM uploaded_files WHERE client_id = :client_id");
        $stmt->bindParam(":client_id", $clientId, PDO::PARAM_INT);
        $stmt->execute();
        $trainingPlans = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($trainingPlans) {
            echo json_encode(["status" => 200, "data" => $trainingPlans]);
        } else {
            $this->handleError(404, "No training plans found for this client.");
        }
    }

    private function getAllEvents(){
        $stmt = $this->pdo->prepare("SELECT * FROM Events");
        $stmt->execute();
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($events) {
            echo json_encode(["status" => 200, "data" => $events]);
        } else {
            $this->handleError(404, "No events found.");
        }
    }

    private function getImagesByEvents($eventIds) {
        $placeholders = implode(',', array_fill(0, count($eventIds), '?'));
        $query = "
        SELECT Gallery.*, Events.event_description, Events.event_name
        FROM Gallery 
        JOIN Events ON Gallery.event_id = Events.event_id 
        WHERE Gallery.event_id IN ($placeholders)";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($eventIds);
        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($images) {
            echo json_encode(["status" => 200, "data" => $images]);
        } else {
            $this->handleError(404, "No images found for these events.");
        }
    }

    private function getReviews() {
        $query = "SELECT Reviews.course_id, Reviews.client_id, Clients.first_name, Clients.last_name, Clients.email, Clients.phone_number, Courses.discipline, Reviews.rating, Reviews.comment
                  FROM Reviews
                  JOIN Clients ON Clients.client_id = Reviews.client_id
                  JOIN Courses ON Courses.course_id = Reviews.course_id
                  WHERE is_response = 0";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($reviews) {
            echo json_encode(["status" => 200, "data" => $reviews]);
        } else {
            echo json_encode(["status" => 404, "message" => "No reviews found."]);
        }
    }

    private function getLessons() {
        $stmt = $this->pdo->prepare("
        SELECT lesson_id, lesson_date, duration, Courses.discipline
        FROM Lessons
        JOIN Courses ON Lessons.course_id = Courses.course_id
        ");
        $stmt->execute();
        $lessons = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($lessons) {
            echo json_encode(["status" => 200, "data" => $lessons]);
        } else {
            $this->handleError(404, "No lessons found.");
        }
    }

    private function getUsersByLessons($lessonId) {
        $stmt = $this->pdo->prepare("
            SELECT first_name, last_name, email, phone_number, duration, lesson_date, discipline
            FROM Clients
            JOIN Reservations ON Clients.client_id = Reservations.client_id
            JOIN Lessons ON Reservations.lesson_id = Lessons.lesson_id
            JOIN Courses ON Lessons.course_id = Courses.course_id
            WHERE Lessons.lesson_id = :lesson_id");

        $stmt->bindParam(":lesson_id", $lessonId, PDO::PARAM_INT);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($users) {
            echo json_encode(["status" => 200, "data" => $users]);
        } else {
            $this->handleError(404, "No users found for this lesson.");
        }
    }

    private function getReservations($lessonId) {
        $stmt = $this->pdo->prepare("
        SELECT Clients.first_name, Clients.last_name, Clients.email, Clients.phone_number, 
               Reservations.reservation_date, Lessons.duration, Courses.discipline
        FROM Reservations
        JOIN Clients ON Reservations.client_id = Clients.client_id
        JOIN Lessons ON Reservations.lesson_id = Lessons.lesson_id
        JOIN Courses ON Lessons.course_id = Courses.course_id
        WHERE Reservations.lesson_id = :lesson_id
    ");

        $stmt->bindParam(":lesson_id", $lessonId, PDO::PARAM_INT);
        $stmt->execute();
        $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($reservations) {
            echo json_encode(["status" => 200, "data" => $reservations]);
        } else {
            $this->handleError(404, "No reservations found for this lesson.");
        }
    }
}

$api = new Api(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD, DB_PORT);
$api->handleRequest();
