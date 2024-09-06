<?php
    require_once ("../../View/includeAll_lib.php");
?>
<!doctype html>
<html lang="it" xmlns="http://www.w3.org/1999/html">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <?php includeStyles() ?>
    <title>Registrazione</title>
</head>
<body>
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration" style="border-radius: 25px;">
                    <div class="card-body p-4 p-mb-5">
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 text-center">Registrati</h3>
                        <form method="POST" id="registration" name="registration" action="registration.php">
                            <div class="row g-2 mb-3">
                                <div class="col-md">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nome">
                                        <label for="name" id="emailField">Nome</label>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Cognome">
                                        <label for="surname">Cognome</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md">
                                    <div class="form-floating">
                                        <label for="phoneNumber"></label><input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Numero di telefono">
                                        <label for="phoneNumber">Numero di telefono</label>
                                    </div>
                                </div>

                                <div class="col-md">
                                    <div class="form-floating">
                                        <label for="email"></label><input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                        <label for="Email">Email</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md">
                                    <div class="form-floating">
                                        <label for="username"></label><input type="text" class="form-control" id="username" name="username" placeholder="Username">
                                        <label for="Username">Username</label>
                                    </div>
                                </div>

                                <div class="col-md">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="Password" name="Password"
                                               placeholder="Password">
                                        <label for="Password">Password</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col g-1 mb-3">
                                <div class="col-md">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="Password2" name="Password2"
                                               placeholder="Password">
                                        <label for="Password2">Password</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-mb text-center">
                                <button type="submit" id="submit" name="submit" class="btn btn-primary">Registrati</button>
                                <button type="submit" id="home" name="home" class="btn btn-primary">Home</button>
                            </div>

                            <div>
                                <span><br>  Hai già un account? <a
                                        href="../Login/indexLogin.php"> Accedi</a> </span>
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