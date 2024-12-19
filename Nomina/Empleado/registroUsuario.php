<?php
require('../conexion/conexion.php');
$objconexion = new conexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nombres"]) || empty($_POST["apellidos"]) || empty($_POST["usuario"]) || empty($_POST["clave"]) || empty($_POST["email"])) {
        echo "<script>alert('Campos vacíos. Por favor, rellena todos los campos.')</script>";
    } else {
        try {
            $checkSql = "SELECT COUNT(*) as total FROM registrar";
            $checkStmt = $objconexion->prepare($checkSql);
            $checkStmt->execute();
            $result = $checkStmt->fetch(PDO::FETCH_ASSOC);

            if ($result['total'] > 0) {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Error',
                            text: 'Ya existe un usuario registrado. No se pueden crear más registros.',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'registroUsuario.php';
                            }
                        });
                    });
                </script>";
            } else {
                $nombres = trim(ucwords($_POST["nombres"]));
                $apellidos = trim(ucwords($_POST["apellidos"]));
                $usuario = trim(ucwords($_POST["usuario"]));
                $correo = trim($_POST["email"]);
                $clave = trim($_POST["clave"]); //md5 sirve para encriptar la contraseña

                $sql = "INSERT INTO registrar (nombres, apellidos, usuario, clave, email) 
                        VALUES (:nombres, :apellidos, :usuario, :clave, :email)";

                $stmt = $objconexion->prepare($sql);
                $stmt->bindValue(':nombres', $nombres, PDO::PARAM_STR);
                $stmt->bindValue(':apellidos', $apellidos, PDO::PARAM_STR);
                $stmt->bindValue(':usuario', $usuario, PDO::PARAM_STR);
                $stmt->bindValue(':clave', $clave, PDO::PARAM_STR);
                $stmt->bindValue(':email', $correo, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Éxito',
                                text: '¡Usuario Agregado Correctamente!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'inicial.php';
                                }
                            });
                        });
                    </script>";
                }
            }
        } catch (Exception $e) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Error: " . addslashes($e->getMessage()) . "',
                        icon: 'error',
                        confirmButtonText: 'Intentar de nuevo'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'registroUsuario.php';
                        }
                    });
                });
            </script>";
        }
    }
}
?>









<!doctype html>
<html lang="en">

<head>
    <title>login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
        <link rel="stylesheet" href="../Css/registro.css?v=1.1"> <!-- ?v=1.1 limpia el cache -->

</head>

<body>

    <div class="container gx-0 login">


        <form action="" class="form" method="POST">
            <div class="informacion">
                <div class="row mb-1">
                    <div class="col text-center">
                        <h1 class="text-center">Registrar Usuario</h1>
                        <img src="../imagenes/logoo.png" alt="" srcset="">
                    </div>
                </div>

                <div class="row gx-0 mb-1">
                    <div class="col-md-12 mb-3 mb-md-0">
                        <label for="nombre" class="form-label">Nombres:</label>
                        <input type="text" name="nombres" class="form-control form-control-xs" required>
                    </div>
                </div>
                <div class="row gx-0 mb-1">
                    <div class="col-md-12 mb-3 mb-md-0">
                        <label for="nombre" class="form-label">Apellidos:</label>
                        <input type="text" name="apellidos" class="form-control form-control-xs" required>
                    </div>
                </div>
                <div class="row gx-0 mb-1">
                    <div class="col-md-12 mb-3 mb-md-0">
                        <label for="nombre" class="form-label">Usuario:</label>
                        <input type="text" name="usuario" class="form-control form-control-xs" required>
                    </div>
                </div>
                <div class="row gx-0 mb-1">
                    <div class="col-md-12 mb-3 mb-md-0">
                        <label for="nombre" class="form-label">Correo:</label>
                        <input type="email" name="email" class="form-control form-control-xs" required>
                    </div>
                </div>
                <div class="row gx-0 mb-1">
                    <div class="col-md-12 mb-3 mb-md-0">
                        <label for="password" class="form-label">Contraseña:</label>
                        <div class="input-group">
                            <input type="password" name="clave" class="form-control form-control-xs" id="password"><i class="fa fa-eye" id="show" style="cursor: pointer"></i>
                        </div>
                    </div>
                </div>
                <div class="row  justify-content-center align-items-center  ">
                <div class="col-md-12 d-flex justify-content-center ">
                    <button type="button" class="btn btn-primary me-2" name="registro">Registrar</button>
                    <a href="../Empleado/login.php" class="btn btn-danger">Cancelar</a>
                </div>
            </div>
            
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
            <style>
                #show {
                    cursor: pointer;
                }
            </style>

            <script>
                document.getElementById('show').addEventListener('click', function() {
                    const passwordInput = document.getElementById('password');
                    const icon = this.querySelector('i');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        passwordInput.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            </script>
            <script
                src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
                integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
                crossorigin="anonymous"></script>

            <script
                src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
                integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
                crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</body>

</html>