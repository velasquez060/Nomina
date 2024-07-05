<?php
require('../conexion/conexion.php');
include('../Menu.php');

$objConexion = new conexion();
$resultado = $objConexion->consultar("SELECT * FROM empleado");

if ($_GET) {
    if (isset($_GET['borrar'])) {
        $id = $_GET['borrar'];
        $objConexion = new conexion();
        $sql = "DELETE FROM empleado WHERE id_Usuario =" . intval($id);
        $objConexion->ejecutar($sql);
        header("Location: ListaEmpleados.php");
        exit();
    }
}
?>

<!doctype html>
<html lang="es">

<head>
    <title>Lista de Empleados</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <link href="/your-path-to-fontawesome/css/v4-shims.css" rel="stylesheet" />
    <link rel="stylesheet" href="../Css/empleado.css">
</head>

<body>

    <H1 class="tituloempleado">Lista de empleados</H1>
    <br>

    <div class="container col-md-8">
        <table class="table col-md-6">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th class="center" scope="col">Nombre</th>
                    <th class="center" scope="col">Apellido</th>
                    <th class="center" scope="col">Cedula</th>
                    <th class="center" scope="col">Celular</th>
                    <th class="center" scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                
                    <?php foreach ($resultado as $proyecto) { ?>
                        <tr>
                            <td class="centered-cell"><img width="70" height="70" src="../fotos/<?php echo $proyecto['fotoempleado']; ?>" alt="" srcset=""></td>
                            <td class="centered-cell"><?php echo $proyecto['nombre']; ?></td>
                            <td class="centered-cell"><?php echo $proyecto['apellido']; ?></td>
                            <td class="centered-cell"><?php echo $proyecto['cedula']; ?></td>
                            <td class="centered-cell"><?php echo $proyecto['celular']; ?></td>
                            <td class="centered-cell">
                                <a class="btn btn-primary" href="#" role="button"><i class="far fa-eye fa-lg"></i></a>
                                <a class="btn btn-primary" href="#" role="button"><i class="fas fa-pencil-alt fa-lg"></i></a>
                                <a class="btn btn-danger" href="#" role="button" onclick="confirmarEliminacion(<?php echo $proyecto['id_Usuario']; ?>)"><i class="far fa-trash-alt fa-lg"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                
            </tbody>
        </table>
    </div>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/solid.js" integrity="sha384-/BxOvRagtVDn9dJ+JGCtcofNXgQO/CCCVKdMfL115s3gOgQxWaX/tSq5V8dRgsbc" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/fontawesome.js" integrity="sha384-dPBGbj4Uoy1OOpM4+aRGfAOc0W37JkROT+3uynUgTHZCHZNMHfGXsmmvYTffZjYO" crossorigin="anonymous"></script>

    <script type="text/javascript">
        function confirmarEliminacion(id) {
            console.log("confirmarEliminacion llamada con id:", id); // Mensaje de depuración
            if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
                window.location.href = "ListaEmpleados.php?borrar=" + id;
            }
        }
    </script>

</body>

</html>