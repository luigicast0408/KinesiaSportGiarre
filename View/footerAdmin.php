<?php
function renderAdminFooter() {
    $html = '
    <footer class="bg-primary text-white text-center py-5 mt-5 shadow-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase mb-3">Admin Panel</h5>
                    <ul class="list-unstyled">
                        <li><a class="text-white" href="/Section/Admin/indexAdmin.php"><i class="bi bi-house-door-fill me-2"></i> Dashboard</a></li>
                        <li><a class="text-white" href="/Section/Admin/showUsersAddFile/indexShowUsersFile.php"><i class="bi bi-person-fill me-2"></i> Users & Files</a></li>
                        <li><a class="text-white" href="/Section/Admin/showAllCourses/indexShowCourses.php"><i class="bi bi-book-fill me-2"></i> Courses</a></li>
                        <li><a class="text-white" href="/Section/Admin/showAllPrivateLessons/indexShowAllPrivateLessons.php"><i class="bi bi-people-fill me-2"></i> Private Lessons</a></li>
                        <li><a class="text-white" href="/Section/Admin/showAllReviews/indexShowReviews.php"><i class="bi bi-chat-dots-fill me-2"></i> Reviews</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase mb-3">Manage</h5>
                    <ul class="list-unstyled">
                        <li><a class="text-white" href="/Section/Admin/addCourse/indexAddCourse.php"><i class="bi bi-plus-circle-fill me-2"></i> Add Course</a></li>
                        <li><a class="text-white" href="/Section/Admin/addLessons/indexAddLessons.php"><i class="bi bi-calendar-plus me-2"></i> Add Lesson</a></li>
                        <li><a class="text-white" href="/Section/Admin/deleteLessons/indexDeleteLessons.php"><i class="bi bi-trash-fill me-2"></i> Delete Lesson</a></li>
                        <li><a class="text-white" href="/Section/Admin/showAllReservationLesson/indexShowAllReservation.php"><i class="bi bi-calendar-check me-2"></i> Reservations</a></li>
                        <li><a class="text-white" href="/Section/Admin/addSchedulesInstructors/indexAddSchedulesInstructor.php"><i class="bi bi-clock-fill me-2"></i> Add Schedules</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a class="text-white" href="/Section/Logout/logout.php"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                        <li><a class="text-white" href="/Section/Help/help.php"><i class="bi bi-question-circle me-2"></i> Help</a></li>
                        <li><a class="text-white" href="/Section/Admin/settings.php"><i class="bi bi-gear-fill me-2"></i> Settings</a></li>
                        <li><a class="text-white" href="/Section/Admin/feedback.php"><i class="bi bi-envelope-fill me-2"></i> Feedback</a></li>
                    </ul>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <hr class="border-white">
                    <p class="mb-0">© ' . date("Y") . ' A.S.D. Kinesia - Giarre(CT) All rights reserved.</p>
                    <p class="mb-0">Admin Panel - Easily manage your courses, lessons, users, and reviews.</p>
                </div>
            </div>
        </div>
    </footer>';
    return $html;
}
?>
