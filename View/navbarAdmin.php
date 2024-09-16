<?php
function renderAdminNavbar() {
    $html = '
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/Section/Admin/indexAdmin.php">ADMIN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/Section/Admin/ShowUsersAddFile/indexShowUsersFile.php">Show User and add file</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Section/Admin/showAllUsers/indexShowUsers.php">Users </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Section/Admin/showAllCourses/indexShowCourses.php">Upload and delete courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Section/Admin/showAllReviews/indexShowReviews.php">Response to reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Section/Admin/addCourse/indexAddCourse.php">Add course</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Section/Admin/addLessons/indexAddLessons.php">Add lesson</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Section/Admin/deleteLessons/indexDeleteLessons.php">Delete lesson</a>    
                    </li
                    <li class="nav-item">
                        <a class="nav-link" href="/Section/Logout/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>';
    echo $html;
}
?>
