<?php
require('../conexion/conexion.php');
include('../Menu.php');

$objConexion = new conexion();
$resultado = $objConexion->consultar("SELECT * FROM empleado");

if ($_GET) {
    if (isset($_GET['borrar'])) {
        $id = $_GET['borrar'];
        $objConexion = new conexion();
        $sql = "DELETE FROM empleado WHERE id_Usuario =" . $id;
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
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="../Css/empleado.css">
</head>

<body>

    <H1 class="tituloempleado">Lista de empleados</H1>
    <br>

    <div class="container col-md-8">
        <table class="table col-md-6">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Cedula</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultado as $proyecto) { ?>
                    <tr>
                        <td> <?php echo $proyecto['id_Usuario']; ?> </td>
                        <td> <?php echo $proyecto['nombre']; ?> </td>
                        <td> <?php echo $proyecto['apellido']; ?> </td>
                        <td> <?php echo $proyecto['cedula']; ?> </td>
                        <td> <?php echo $proyecto['celular']; ?> </td>
                        <td>
                            <a class="btn btn-primary" href="#" role="button">Vista</a>
                            <a class="btn btn-primary" href="#" role="button">Actualizar</a>
                            <a class="btn btn-danger" href="#" role="button" onclick="confirmarEliminacion(<?php echo $proyecto['id_Usuario']; ?>)">Eliminar</a>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        function confirmarEliminacion(id_Usuario) {
            if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
                window.location.href = "ListaEmpleados.php?borrar=" + id_Usuario;
            }
        }
    </script>

</body>

</html>