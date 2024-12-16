<?php
function renderAdminHeader($title, $backUrl = "/Section/Admin/indexAdmin.php") {
    return '
    <div class="d-flex justify-content-between align-items-center p-3 mb-4 bg-primary text-white border-bottom shadow-sm rounded">
        <h3 class="m-0 fw-bold">' . htmlspecialchars($title) . '</h3>
        <a href="' . htmlspecialchars($backUrl) . '" class="btn btn-light btn-sm d-flex align-items-center">
            <i class="bi bi-arrow-left me-2"></i> Back to Dashboard
        </a>
    </div>';
}