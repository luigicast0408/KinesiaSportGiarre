<?php
require_once("../../dbConnection/DB_connection.php");

function showEvents(): void
{
    $connection = DBConnect();
    $query = "SELECT *  FROM Events ";
    $stm = $connection->prepare($query);
    $stm->execute();
    $events = $stm->fetchAll(PDO::FETCH_ASSOC);

    $html = '<div class="container-fluid"> 
    <div class="row">';
    $i = 0;

    foreach ($events as $row)
    {
        $class = "card-bg-" . ($i);
        $html .= '
        <div class="col-md-4 mb-4">
            <div class="card h-100 '.$class.'">
                <img class="card-img-top" src="' . $row['image'] . '" alt="">
                <div class="card-body">
                    <h4 class="card-title">' . $row['event_name'] . '</h4>
                    <p class="card-text">' . $row['type'] . '</p>
                    <p class="card-text">' . $row['event_description'] . '</p>
                    <p class="card-text">' . $row['date'] . '</p>
                </div>
            </div>
        </div>
        ';

        $i++;
        if ($i % 3 == 0) {
            $html .= '</div><div class="row">';
        }
    }
    $html .= '</div></div>';

    echo $html;

    $connection = null;
}

?>
