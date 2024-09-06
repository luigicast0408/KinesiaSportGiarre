<?php
session_start();
function navbar(): void
{
    echo '
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/Section/Home/index.php">
                <img src="/Images/logo.png" id="l1" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
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
                        <a class="nav-link" href="https://www.messenger.com/loginOld.php?next=https%3A%2F%2Fwww.messenger.com%2Ft%2F1489507401373047%2F%3Fmessaging_source%3Dsource%253Apages%253Amessage_shortlink%26source_id%3D1441792%26recurring_notification%3D0">
                            <i class="fab fa-facebook-messenger"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-light bg-body-tertiary">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
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
                    <li>
                    <a class="nav-link" href="/Section/TrainingPlans/indexTrainingPlans.php">Schede Allenamento</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
    viewUser();
    echo '</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/Section/Registration/indexRegistration.php">Registration</a></li>
                            <li><a class="dropdown-item" href="/Section/Login/indexLogin.html">Login</a></li>
                            <li><a class="dropdown-item" href="/Section/Logout/logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
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
