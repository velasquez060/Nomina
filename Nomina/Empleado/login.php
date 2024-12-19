<?php
include "../Conexion/cone.php";
include "../Empleado/controlador.php";
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
    <link rel="stylesheet" href="../Css/login.css">
</head>

<body>

    <div class="container gx-0 login">


        <form action="" class="form" method="POST">
            <div class="informacion">
                <div class="row mb-1">
                    <div class="col text-center">
                        <h1 class="text-center">Iniciar Sesión</h1>
                        <img class="image" src="../imagenes/logoo.png" alt="" srcset="">
                    </div>
                </div>


                <div class="row gx-0 mb-1">
                    <div class="col-md-12 mb-3 mb-md-0">
                        <label for="nombre" class="form-label">Usuario:</label>
                        <input type="text" name="nombre" class="form-control form-control-xs">
                    </div>
                </div>
                <div class="row gx-0 mb-1">
                    <div class="col-md-12 mb-3 mb-md-0">
                        <label for="password" class="form-label">Contraseña:</label>
                        <div class="input-group">
                            <input type="password"  name="password" class="form-control form-control-xs" id="password"><i class="fa fa-eye" id="show" style="cursor: pointer" ></i>
                        </div>
                        </span>
                    </div>
                </div>
                <div class="row  mb-1">
                    <div class="col-md-12 mb-3 mb-md-0">
                        <input class="button" type="submit" value="INICIAR SESIÓN" name="ingresar" "></input>
                    </div>
                </div>
                <div class=" row gx-0 mb-1">
                        <div class="col-md-12 mb-3 mb-md-0 text-center">
                            <label for="#">
                                <a href="recuperar.php">Olvidé mi contraseña</a>
                            </label>
                        </div>
                    </div>
                    <div class="row gx-0 mb-1">
                        <div class="col-md-12 mb-3 mb-md-0 text-center">
                            <label for="#">
                                <a href="../Empleado/registroUsuario.php">Registrarse</a>
                            </label>
                        </div>
                    </div>
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