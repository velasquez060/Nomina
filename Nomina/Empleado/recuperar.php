<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include "../Conexion/cone.php";

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}


?>

<!doctype html>
<html lang="en">

<head>
    <title>Recuperar Contraseña</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="../Css/recuperar.css?v=1.1">
</head>

<body>
    <div class="container gx-0 login">
        <form action="" class="form" method="POST">
            <div class="row gx-0 mb-2">
                <div class="col-md-12 mb-3 mb-md-0">
                    <img src="../imagenes/logoo.png" alt="" srcset="">
                </div>
            </div>
            <div class="row gx-0 mb-3">
                <div class="col-md-12 mb-3 mb-md-0">
                    <label for="email" class="form-label">Correo:</label>
                    <input type="email" name="email" class="form-control form-control-xs" required>
                </div>
            </div>
            <div class="row justify-content-center align-items-center">
                <div class="col-md-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary me-2" name="enviar">Enviar</button>
                    <a href="../Empleado/login.php" class="btn btn-danger">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>