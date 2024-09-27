<?php
session_start();
function navbar(): void
{
    echo '
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="d-flex align-items-center w-100">
                <a class="navbar-brand d-flex align-items-center" href="/Section/Home/index.php">
                    <img src="/Images/logo.png" id="l1" alt="Logo" style="height: auto; width: 20%"> 
                    <span style="font-size: 2rem; font-weight: bold; margin-left: 10px;">ASD Kinesia</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="tel:+1234567890">
                                <i class="fas fa-phone"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="mailto:prova@gmail.com">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.facebook.com/">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.instagram.com/">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.youtube.com/">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://api.whatsapp.com/send?phone=3207049867">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.messenger.com/">
                                <i class="fab fa-facebook-messenger"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto">
                        <!-- Main Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="/Section/Home/index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Section/Courses/indexCourses.php">Corsi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Section/Instructors/indexInstructor.php">Insegnanti</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Section/Events/indexEvents.php">Eventi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Section/ContactUs/indexContactUs.php">Contatti</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Section/Gallery/indexGallery.php">Galleria</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Section/TrainingPlans/indexTrainingPlans.php">Schede Allenamento</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Section/Reviews/addReviews/indexReviews.php">Recenzioni</a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link" href="/Section/PrivateLessons/indexPrivateLessons.php">Prenota un trattamento</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
    viewUser();
    echo '</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/Section/Registration/indexRegistration.php">Registration</a></li>
                                <li><a class="dropdown-item" href="/Section/Login/indexLogin.php">Login</a></li>
                                <li><a class="dropdown-item" href="/Section/Logout/logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>';
}

function viewUser(): void
{
    if (isset($_SESSION['name']) && isset($_SESSION['surname'])) {
        echo $_SESSION['name'] . ' ' . $_SESSION['surname'];
    } else {
        echo "Utente";
    }
}
?>
