<?php
require_once ("../../View/includeAll_lib.php");
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <?php includeStyles() ?>
    <title>Login</title>
</head>
<body class="text-center">
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration" style="border-radius: 25px;">
                    <div class="card-body p-4 p-mb-5">
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 text-center">Accedi</h3>
                        <form method="post" action="login.php">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                       aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <button type="submit" class="btn btn-primary" id="login" name="login">Accedi</button>
                            <button type="submit" class="btn btn-primary" id="home" name="home">
                                 <i class="bi bi-house"></i>  Home
                            </button>
                            <div>
                                <span><br>  Non hai un account? <a href="../Registration/indexRegistration.php"> Registrati</a> </span>
                                <span><br> Password dimeticata? <a href="">Recupera password</a> </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>
