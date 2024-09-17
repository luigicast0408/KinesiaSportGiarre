<?php
function generateFooter()
{
    echo '
    <div class="container-fluid">
        <footer class="bg-dark text-light py-4">
            <div class="container">
                <div class="row text-md-left">
                    <div class="col-md-3 mb-3">
                        <img src="/Images/logo.png" id="l1" alt="Logo" style="height: 80px; width: 80px;">
                    </div>
                    <div class="col-md-3 mb-3">
                        <h5>Link Utili</h5>
                        <ul class="list-unstyled">
                            <li><a href="/Section/Home/index.php" class="footer-link">Home</a></li>
                            <li><a href="/Section/Courses/indexCourses.php" class="footer-link">Corsi</a></li>
                            <li><a href="/Section/Instructors/indexInstructor.php" class="footer-link">Insegnanti</a></li>
                            <li><a href="/Section/ContactUs/indexContactUs.php" class="footer-link">Contatti</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 mb-3">
                        <h5>Orari di Apertura</h5>
                        <ul class="list-unstyled">
                            <li>Lun - Ven: 9:00 - 21:00</li>
                            <li>Sab: 10:00 - 18:00</li>
                            <li>Dom: Chiuso</li>
                        </ul>
                    </div>
                   <div class="col-md-3 mb-5">
    <h5>Contatti</h5>
    <ul class="list-unstyled">
        <li>
            <p><i class="fas fa-phone" style="color: white;"></i> <strong>Telefono:</strong>
                <a href="tel:+393477157985" class="footer-link">3477157985 (Vera Sorbello)</a>
            </p>
        </li>
        <li>
            <p><i class="fas fa-phone" style="color: white;"></i> <strong>Telefono:</strong>
                <a href="tel:+393280850471" class="footer-link">3280850471 (Salvatore Parisi)</a>
            </p>
        </li>
        <li>
            <p><i class="fas fa-envelope" style="color: white;"></i> <strong>Email:</strong>
                <a href="mailto:info@example.com" class="footer-link">info@example.com</a>
            </p>
        </li>
        <li>
            <p><i class="fas fa-map-marker-alt" style="color: white;"></i> <strong>Indirizzo:</strong>
                <span>Via Rosolino Pilo, 32, 95014 Giarre CT</span>
            </p>
        </li>
        <li>
            <p><i class="fas fa-map-marker-alt" style="color: white;"></i> <strong>Indirizzo:</strong>
                <span>Via Vincenzo Bellini, 11, 95014 Giarre CT</span>
            </p>
        </li>
    </ul>
</div>

                </div>
            </div>
        </footer>

        <!-- Copyright and Webmaster -->
        <footer class="bg-light py-2">
            <div class="container-fluid text-center">
                <div class="row">
                    <div class="col-md">
                        <p class="mb-0 text-dark">
                            Copyright © ASD Kinesia Sport Giarre. All Rights Reserved.
                            <br>Web Master: <a href="https://instagram.com/luigi_cast08" target="_blank" class="text-dark" title="Profilo Instagram">Luigi Domenico Castano</a>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>';
}
?>
