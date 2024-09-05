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
                        <a class="nav-link active" aria-current="page" href="/Section/Admin/ShowUsers/indexShowUsers.php">Show Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Users </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Settings</a>
                    </li>
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
