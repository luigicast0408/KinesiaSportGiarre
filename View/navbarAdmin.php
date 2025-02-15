<?php
function renderAdminNavbar() {
    $html = '
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="/Section/Admin/indexAdmin.php">
                <i class="bi bi-gear-fill me-2"></i> ADMIN PANEL
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/Section/Admin/showUsersAddFile/indexShowUsersFile.php">
                            <i class="bi bi-person-fill"></i> Show User and Add File
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="coursesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-book-fill"></i> Courses
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="coursesDropdown">
                            <li><a class="dropdown-item" href="/Section/Admin/showAllCourses/indexShowCourses.php">Manage Courses</a></li>
                            <li><a class="dropdown-item" href="/Section/Admin/addCourse/indexAddCourse.php">Add Course</a></li>
                            <li><a class="dropdown-item" href="/Section/Admin/deleteLessons/indexDeleteStage.php">Delete Lesson</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="lessonsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-calendar3"></i> Lessons
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="lessonsDropdown">
                            <li><a class="dropdown-item" href="/Section/Admin/addStage/indexAddStage.php">Add Lesson</a></li>
                            <li><a class="dropdown-item" href="/Section/Admin/showAllReservationLesson/indexShowAllReservation.php">Reservations</a></li>
                            <li><a class="dropdown-item" href="/Section/Admin/addSchedulesInstructors/indexAddSchedulesInstructor.php">Add Private Lessons</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Section/Admin/showAllPrivateLessons/indexShowAllPrivateLessons.php">
                            <i class="bi bi-people-fill"></i> Private Lessons
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Section/Admin/showAllReviews/indexShowReviews.php">
                            <i class="bi bi-chat-dots-fill"></i> Reviews
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="/Section/Logout/logout.php">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>';
    return $html;
}
