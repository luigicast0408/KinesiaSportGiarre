<?php
require_once("../../dbConnection/DB_connection.php");

function displayGallery($eventIds)
{
    $conn = DBConnect();
    $query = "
        SELECT Gallery.*, Events.event_description, Events.event_name
        FROM Gallery 
        JOIN Events ON Gallery.event_id = Events.event_id 
        WHERE Gallery.event_id IN (" . implode(',', $eventIds) . ")";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $images = $stmt->fetchAll();

    // Group images and descriptions by event
    $imagesByEvent = [];
    $descriptions = [];
    $eventName = [];
    foreach ($images as $image) {
        $eventId = $image['event_id'];
        if (!isset($imagesByEvent[$eventId])) {
            $imagesByEvent[$eventId] = [];
            $descriptions[$eventId] = $image['event_description']; // Save event description
            $eventName[$eventId] = $image['event_name'];
        }
        $imagesByEvent[$eventId][] = $image;
    }

    foreach ($eventIds as $eventId):
        if (isset($imagesByEvent[$eventId])): ?>
            <div class="card mb-2" style="max-width: 30%; max-height: 40%;">
                <div class="card-header">
                    <h5 class="card-title"><?php echo $eventName[$eventId]; ?></h5>
                </div>
                <div class="card-body">
                    <div id="carouselEvent<?php echo $eventId; ?>" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($imagesByEvent[$eventId] as $index => $image):
                                $activeClass = $index === 0 ? 'active' : ''; ?>
                                <div class="carousel-item <?php echo $activeClass; ?>">
                                    <img src="<?php echo $image['link']; ?>" class="d-block w-100 img-fluid" alt="<?php echo $image['type']; ?>" style="max-height: 200px;">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselEvent<?php echo $eventId; ?>" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselEvent<?php echo $eventId; ?>" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <p class="card-text mt-3"><?php echo $descriptions[$eventId]; ?></p>
                </div>
            </div>
        <?php endif ?>
    <?php endforeach;
}
?>
