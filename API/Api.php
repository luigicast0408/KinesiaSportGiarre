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
            $this->handleError(500, "Error in the server: " . $e->getMessage());
        }
    }

    private function handleError($status, $message){
        echo json_encode(["status" => $status, "message" => $message]);
        exit;
    }

    public function handleRequest(): void{
        if (isset($_GET['request'])) {
            switch ($_GET['request']) {
                case 'courses':{
                    if (isset($_GET['section'])) {
                        $section = (int)$_GET['section'];
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
                    if (isset($_GET['profile'])) {
                        $profile = (int)$_GET['profile'];
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
                    if (isset($_GET['eventIds'])) {
                        $eventIds = explode(',', $_GET['eventIds']);
                        $this->getImagesByEvents($eventIds);
                    } else {
                        $this->handleError(400, "Event IDs parameter is missing.");
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

    private function getClients(){
        $stmt = $this->pdo->prepare("SELECT client_id, first_name, last_name, phone_number, email FROM Clients WHERE isAdmin = 0");
        $stmt->execute();
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($clients as &$client) {
            $clientId = $client['client_id'];
            $targetDir = __DIR__ . "/uploads/clients/{$clientId}/"; // Adjusted the path
            $client['file_exists'] = file_exists($targetDir) && !empty(glob($targetDir . "*"));
        }

        if ($clients) {
            echo json_encode(["status" => 200, "clients" => $clients]);
        } else {
            $this->handleError(404, "No clients found");
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

}

$api = new Api(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD, DB_PORT);
$api->handleRequest();