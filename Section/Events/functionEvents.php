<?php
require_once("../../dbConnection/DB_connection.php");
require_once("functionEvents.php");

function showEvents(): void
{
    $connection = DBConnect();
    $query = "SELECT * FROM Events WHERE  type='saggio'";
    $stm = $connection->prepare($query);
    $stm->execute();
    $events = $stm->fetchAll(PDO::FETCH_ASSOC);

    $html = '<div class="container py-4"> 
    <div class="row">';

    foreach ($events as $index => $row) {
        $html .= '
    <div class="col-md-4 mb-4 d-flex">
        <div class="card shadow-sm border-light rounded-lg overflow-hidden d-flex flex-column w-100">
            <div class="position-relative">
                <img class="card-img-top event-image" src="' . $row['image_link'] . ' " 
                     alt="' . htmlspecialchars($row['event_name']) . '" 
                     style="height: 1020px; object-fit: cover; width: 100%; transition: transform 0.3s ease-in-out;">
                <div class="event-date position-absolute top-0 end-0 bg-primary text-white px-3 py-1 rounded-bottom-start">
                    <small>' . date("d M Y", strtotime($row['date'])) . '</small>
                </div>
            </div>
            <div class="card-body d-flex flex-column text-center flex-grow-1">
                <h5 class="card-title text-dark fw-bold">' . htmlspecialchars($row['event_name']) . '</h5>
                <p class="card-text text-muted flex-grow-1">' . nl2br(htmlspecialchars($row['event_description'])) . '</p>
            </div>
        </div>
    </div>';
    }





    $html .= '</div></div>';

    echo $html;
    $connection = null;
}
