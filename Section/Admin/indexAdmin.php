<?php
require_once ("../../View/navbarAdmin.php");
require_once ("../../View/includeAll_lib.php");
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../style/style_footer.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_nav.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_cards.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_header.css">
    <link rel="stylesheet" type="text/css" href="../../style/style_sidebarAdmin.css">
    <title>ADMIN </title>
    <?php includeStyles() ?>
</head>
<body>
<?php echo renderAdminNavbar() ?>
<!-- Sidebar -->
<!-- Sidebar -->
<div class="sidebar p-3">
    <h4 class="text-center py-3 border-bottom">Admin</h4>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="/Section/Admin/indexAdmin.php">
                <i class="bi bi-speedometer2 me-2"></i> <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="/Section/Admin/showUsersAddFile/indexShowUsersFile.php">
                <i class="bi bi-person-bounding-box me-2"></i> <span>Users & Files</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="/Section/Admin/showAllCourses/indexShowCourses.php">
                <i class="bi bi-book-fill me-2"></i> <span>Courses</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="/Section/Admin/showAllPrivateLessons/indexShowAllPrivateLessons.php">
                <i class="bi bi-person-video3 me-2"></i> <span>Private Lessons</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center text-danger" href="/Section/Logout/logout.php">
                <i class="bi bi-box-arrow-right me-2"></i> <span>Logout</span>
            </a>
        </li>
    </ul>
</div>

</body>
</html>


