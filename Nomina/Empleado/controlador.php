<?php
session_start();
if (!empty ($_POST["ingresar"])) {
    if (!empty($_POST["nombre"]) && !empty($_POST["password"])) {
        $usuario=$_POST["nombre"];
        $contraseña=$_POST["password"];
        $sql=$conexion ->query("select * from registrar where usuario='$usuario' and clave='$contraseña'");
        if ($datos=$sql->fetch_object()) {
            $_SESSION["id"]=$datos->id;
            $_SESSION["nombre"]=$datos->nombres;
            $_SESSION["apellido"]=$datos->apellidos;
            header("location: inicial.php");
        } else {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Error: Usuario no valido!',
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
        # code...
    }
    
}

?>