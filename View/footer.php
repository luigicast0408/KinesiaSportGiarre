<?php
function generateFooter() {
    echo '<div class="container-fluid">
        <footer class="bg-dark text-light" style="margin-top: 5%; padding: 20px 0;">
            <div class="container">
                <div class="row text-center text-md-left">
                    <div class="col-md-3 mb-4">
                        <img src="../Images/logo.png" id="l1" alt="Logo" style="height: 80px; width: 80px;">
                    </div>
                    
                    <div class="col-md-3 mb-4">
                        <h5>Link Utili</h5>
                        <ul class="list-unstyled">
                            <li><a href="/Section/Home/index.php" class="text-light">Home</a></li>
                            <li><a href="/Section/Courses/indexCourses.php" class="text-light">Corsi</a></li>
                            <li><a href="/Section/Instructors/indexInstructor.php" class="text-light">Insegnanti</a></li>
                            <li><a href="/Section/ContactUs/indexContactUs.php" class="text-light">Contatti</a></li>
                        </ul>
                    </div>
                    
                    <div class="col-md-3 mb-4">
                        <h5>Orari di Apertura</h5>
                        <ul class="list-unstyled">
                            <li>Lun - Ven: 9:00 - 21:00</li>
                            <li>Sab: 10:00 - 18:00</li>
                            <li>Dom: Chiuso</li>
                        </ul>
                    </div>

                    <div class="col-md-3 mb-4">
                        <h5>Sedi</h5>
                        <ul class="list-unstyled">
                            <li>Giarre, Via Roma 123</li>
                            <li>Catania, Via Etnea 456</li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>';

    echo '<footer class="bg-light">
            <div class="container-fluid text-center">
                <div class="row">
                    <div class="col-md">
                        <p class="mb-0" style="color: black;">Copyright © ASD Kinesia Sport Giarre. All Rights Reserved.
                            <br>Web Master: <a style="color: black" href="https://instagram.com/luigi_cast08" target="_blank" title="Profilo Instagram">Luigi Domenico Castano</a>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>';
}