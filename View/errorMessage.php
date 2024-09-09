<?php

function showMessage($message, $type = 'success') {
    $alertClass = $type === 'success' ? 'alert-success' : 'alert-danger';
    echo '
    <div class="container mt-4">
        <div class="alert ' . $alertClass . ' alert-dismissible fade show" role="alert">
            <strong>' . ucfirst($type) . '!</strong> ' . $message . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>';
}
?>
