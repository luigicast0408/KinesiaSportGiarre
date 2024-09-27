<?php

require_once("../dbConnection/config.php");

class Api {
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
                case 'reviewsAdmin':{
                    $this->getReviewsAdmin();
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
                case 'getId':{
                    $this->getIDofInstructorSchedule($_GET['instructorId'], $_GET['day'], $_GET['start_time'], $_GET['end_time']);
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
                case 'instructors':{
                    $this->getInstructors();
                    break;
                }
                case 'instructorSchedules':{
                    $instructorId = isset($_GET['instructorId']) ? (int)$_GET['instructorId'] : null;
                    if ($instructorId !== null) {
                        $this->getInstructorScheduels($instructorId);
                    } else {
                        $this->handleError(400, "Instructor ID parameter is missing.");
                    }
                    break;
                }
                case 'privateLessons':{
                    $instructorId = isset($_GET['instructorId']) ? (int)$_GET['instructorId'] : null;
                    if (isset($_GET['instructor_id']) && !empty($_GET['instructor_id'])) {
                        $instructorId = intval($_GET['instructor_id']); // Convert to integer to prevent SQL injection
                        $this->getAllPrivateLessons($instructorId);
                    } else {
                        echo json_encode(['status' => 400, 'message' => 'Instructor ID is missing']);
                        exit;
                    }
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
        $stmt = $this->pdo->prepare("SELECT course_id, discipline, course_description, image_link FROM Courses WHERE section = :section AND type ='unit'");
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

    private function getReviewsAdmin() {
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

    private function getReviews(){
        $query = "SELECT Reviews.course_id, Reviews.client_id, Clients.first_name, Clients.last_name, Clients.email, Clients.phone_number, Courses.discipline, Reviews.rating, Reviews.comment,response_test
                  FROM Reviews
                  JOIN Clients ON Clients.client_id = Reviews.client_id
                  JOIN Courses ON Courses.course_id = Reviews.course_id
                  WHERE is_response = 1";

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
        WHERE Lessons.type = 'lesson'
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
            JOIN Reservation ON Clients.client_id = Reservation.client_id
            JOIN Lessons ON Reservation.lesson_id = Lessons.lesson_id
            JOIN Courses ON Lessons.course_id = Courses.course_id
            WHERE Lessons.lesson_id = :lesson_id AND Lessons.type = 'lesson'
        ");

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
               Reservation.reservation_date, Lessons.duration, Courses.discipline
        FROM Reservation
        JOIN Clients ON Reservation.client_id = Clients.client_id
        JOIN Lessons ON Reservation.lesson_id = Lessons.lesson_id
        JOIN Courses ON Lessons.course_id = Courses.course_id
        WHERE Reservation.lesson_id = :lesson_id
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

    private function getInstructors(){
        $stmt = $this->pdo->prepare("SELECT instructor_id, first_name, last_name, email, phone_number FROM Instructors");
        $stmt->execute();
        $instructors = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($instructors) {
            echo json_encode(["status" => 200, "instructors" => $instructors]);
        } else {
            $this->handleError(404, "No instructors found.");
        }
    }

    private function getInstructorScheduels($instructorId): void{
        $stmt = $this->pdo->prepare("
        SELECT start_time, end_time, day_of_week
        FROM InstructorSchedules
        WHERE instructor_id = :instructor_id
    ");
        $stmt->bindParam(":instructor_id", $instructorId, PDO::PARAM_INT);
        $stmt->execute();
        $lessons = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($lessons) {
            echo json_encode(["status" => 200, "data" => $lessons]);
        } else {
            $this->handleError(404, "No lessons found for this instructor.");
        }
    }

    private function getIDofInstructorSchedule($instructorId, $day, $start_time, $end_time){
        $stmt = $this->pdo->prepare("
        SELECT instructor_schedule_id 
        FROM InstructorSchedules 
        WHERE instructor_id = :instructor_id 
          AND day_of_week = :day 
          AND start_time = :start_time 
          AND end_time = :end_time
    ");

        $stmt->bindParam(":instructor_id", $instructorId, PDO::PARAM_INT);
        $stmt->bindParam(":day", $day, PDO::PARAM_INT);
        $stmt->bindParam(":start_time", $start_time, PDO::PARAM_STR);
        $stmt->bindParam(":end_time", $end_time, PDO::PARAM_STR);

        $stmt->execute();
        $id = $stmt->fetchColumn();

        if ($id) {
            echo json_encode(["status" => 200, "data" => $id]);
        } else {
            echo json_encode(["status" => 404, "message" => "No ID found for this instructor schedule."]);
        }
    }

    private function getAllPrivateLessons($instructorId): void {
        try {
            $stmt = $this->pdo->prepare("
        SELECT PrivateLessons.private_lesson_id, PrivateLessons.date, InstructorSchedules.start_time, InstructorSchedules.end_time, 
               Clients.first_name, Clients.last_name, Clients.email, Clients.phone_number
        FROM PrivateLessons
        JOIN Clients ON PrivateLessons.client_id = Clients.client_id
        JOIN InstructorSchedules ON PrivateLessons.instructor_schedule_id = InstructorSchedules.instructor_schedule_id
        WHERE InstructorSchedules.instructor_id = :instructor_id
    ");
            $stmt->bindParam(':instructor_id', $instructorId, PDO::PARAM_INT);
            $stmt->execute();
            $lessons = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($lessons) {
                echo json_encode(["status" => 200, "data" => $lessons]);
            } else {
                echo json_encode(["status" => 404, "message" => "No private lessons found for this instructor."]);
            }
        } catch (PDOException $e) {
            echo json_encode(["status" => 500, "message" => "Error: " . $e->getMessage()]);
        }
        exit();
    }
}

$api = new Api(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD, DB_PORT);
$api->handleRequest();
