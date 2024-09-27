<?php
require_once("../../../View/includeAll_lib.php");
require_once("../../../View/navbarAdmin.php");
require_once ("../../../dbConnection/DB_connection.php");
$connection = DBConnect();

$query = "SELECT * FROM InstructorSchedules WHERE instructor_schedule_id = :schedule_id";
$stm = $connection->prepare($query);
$stm->bindParam(':schedule_id', $_GET['schedule_id']);
$stm->execute();
$schedules = $stm->fetchAll(PDO::FETCH_ASSOC);

if ($schedules) {
    $schedule = $schedules[0];
    $day = $schedule['day_of_week'];
    $start_time = $schedule['start_time'];
    $end_time = $schedule['end_time'];
    $duration = (strtotime($end_time) - strtotime($start_time)) / 60;
} else {
    $day = $start_time = $duration = '';
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../../style/style_footer.css">
    <link rel="stylesheet" type="text/css" href="../../../style/style_nav.css">
    <link rel="stylesheet" type="text/css" href="../../../style/style_cards.css">
    <link rel="stylesheet" type="text/css" href="../../../style/style_header.css">
    <?php includeStyles() ?>
    <title>Modifica Orari Disponibili</title>
</head>
<body>
<?php renderAdminNavbar(); ?>

<div class="header">
    <h3>Modifica Orari Disponibili per Insegnante</h3>
</div>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <form method="POST" id="addHoursForm" class="mb-4" action="updateSchedules.php">
                <div class="mb-3">
                    <label for="day" class="form-label">Giorno:</label>
                    <select id="day" name="day" class="form-select" required>
                        <option value="1" <?= $day == 1 ? 'selected' : '' ?>>Lunedì</option>
                        <option value="2" <?= $day == 2 ? 'selected' : '' ?>>Martedì</option>
                        <option value="3" <?= $day == 3 ? 'selected' : '' ?>>Mercoledì</option>
                        <option value="4" <?= $day == 4 ? 'selected' : '' ?>>Giovedì</option>
                        <option value="5" <?= $day == 5 ? 'selected' : '' ?>>Venerdì</option>
                        <option value="6" <?= $day == 6 ? 'selected' : '' ?>>Sabato</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="time" class="form-label">Orario Inizio:</label>
                    <input type="time" id="time" name="time" class="form-control" value="<?= htmlspecialchars($start_time) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="duration" class="form-label">Durata (minuti):</label>
                    <input type="number" id="duration" name="duration" class="form-control" value="<?= htmlspecialchars($duration) ?>" required>
                </div>

                <div class="mb-3">
                    <input type="hidden" name="schedule_id" id="schedule_id" value="<?= htmlspecialchars($_GET['schedule_id']) ?>">
                    <button type="submit" class="btn btn-primary">Modifica Orario</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
