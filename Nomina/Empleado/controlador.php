<?php
session_start();
require('../conexion/conexion.php'); // Asegúrate de incluir la conexión a la base de datos

if (!empty($_POST["ingresar"])) {
    if (!empty($_POST["nombre"]) && !empty($_POST["password"])) {
        $usuario = trim($_POST["nombre"]);
        $contraseña = trim($_POST["password"]);

        // Consulta preparada para evitar inyección SQL
        $sql = $conexion->prepare("SELECT * FROM registrar WHERE usuario = ?");
        $sql->bind_param("s", $usuario);
        $sql->execute();
        $resultado = $sql->get_result();

        if ($datos = $resultado->fetch_object()) {
            // Verificar la contraseña usando password_verify()
            if (password_verify($contraseña, $datos->clave)) {
                // Credenciales válidas, iniciar sesión
                $_SESSION["id"] = $datos->id;
                $_SESSION["nombre"] = $datos->nombres;
                $_SESSION["apellido"] = $datos->apellidos;
                header("location: inicial.php");
            } else {
                // Contraseña incorrecta
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Error',
                            text: 'Contraseña incorrecta',
                            icon: 'error',
                            confirmButtonText: 'Intentar de nuevo'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'login.php';
                            }
                        });
                    });
                </script>";
            }
        } else {
            // Usuario no encontrado
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Usuario no encontrado',
                        icon: 'error',
                        confirmButtonText: 'Intentar de nuevo'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'login.php';
                        }
                    });
                });
            </script>";
        }
    } else {
        // Campos vacíos
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Por favor, completa todos los campos',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
    }
}
?>

