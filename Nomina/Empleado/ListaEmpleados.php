<?php
require('../conexion/conexion.php');




$objConexion = new conexion();
$resultado = $objConexion->consultar("SELECT * FROM empleado");


if ($_GET) {
    if (isset($_GET['borrar'])) {
        $id = $_GET['borrar'];
        $objConexion = new conexion();
        $sql = "DELETE FROM empleado WHERE id_Usuario = $id";
        $objConexion->ejecutar($sql);
        $mensaje = "Registro eliminado";
        header("Location: ListaEmpleados.php?mensaje=" . $mensaje);
        exit();
    }
}
?>
<?php
include('../Menu.php');
?>
<?php if (isset($_GET['mensaje'])) { ?>
    <script>
        window.onload = function() {
            Swal.fire({
                icon: "success",
                title: "<?php echo $_GET['mensaje']; ?>"
            });
        };
    </script>
<?php } ?>



<!doctype html>
<html lang="es">

<head>
    <title>Lista de Empleados</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <link href="/your-path-to-fontawesome/css/v4-shims.css" rel="stylesheet" />
    <link rel="stylesheet" href="../Css/empleado.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <h1 class="tituloempleado">Lista de empleados</h1>
    <br>
    <div class="container col-md-8">
        <table class="table-responsive-sm" id="tabla_id">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Nombre:</th>
                    <th scope="col">Apellido:</th>
                    <th scope="col">Cedula:</th>
                    <th scope="col">Celular:</th>
                    <th scope="col">Documentos:</th>
                    <th scope="col">Opciones:</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultado as $proyecto) { ?>
                    <tr>
                        <td><img width="70" height="70" src="../fotos/<?php echo $proyecto['fotoempleado']; ?>" alt="" srcset=""></td>
                        <td><?php echo htmlspecialchars ($proyecto['nombre']); ?></td>
                        <td><?php echo htmlspecialchars ($proyecto['apellido']); ?></td>
                        <td><?php echo htmlspecialchars ($proyecto['cedula']); ?></td>
                        <td><?php echo htmlspecialchars ($proyecto['celular']); ?></td>
                        <td>
                            <?php if (!empty($proyecto['archivo'])) : ?>
                                <a href="<?php echo htmlspecialchars($proyecto['archivo']); ?>">
                                    <?php
                                    $archivo = basename($proyecto['archivo']);
                                    $archivo_mostrado = (strlen($archivo) > 10) ? substr($archivo, 0, 12) . '...' : $archivo;
                                    echo htmlspecialchars($archivo_mostrado);
                                    ?>
                                </a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a class="btn btn-primary" href="#" onclick="verEmpleado(<?php echo $proyecto['id_Usuario']; ?>)" role="button"><i class="far fa-eye fa-lg"></i></a>
                            <a class="btn btn-primary" href="#" role="button"><i class="fas fa-pencil-alt fa-lg"></i></a>
                            <a class="btn btn-danger" href="javascript:borrar(<?php echo $proyecto['id_Usuario']; ?>);" role="button"><i class="far fa-trash-alt fa-lg"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>




    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/solid.js" integrity="sha384-/BxOvRagtVDn9dJ+JGCtcofNXgQO/CCCVKdMfL115s3gOgQxWaX/tSq5V8dRgsbc" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/fontawesome.js" integrity="sha384-dPBGbj4Uoy1OOpM4+aRGfAOc0W37JkROT+3uynUgTHZCHZNMHfGXsmmvYTffZjYO" crossorigin="anonymous"></script>
    <script>
        function borrar(id_Usuario) {
            Swal.fire({
                title: "¿Desea borrar el registro?",
                showCancelButton: true,
                confirmButtonText: "Si, Borrar"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "ListaEmpleados.php?borrar=" + id_Usuario;
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            $("#tabla_id").DataTable({
                "pageLength": 3,
                lengthMenu: [
                    [3, 10, 25, 50],
                    [3, 10, 25, 50]
                ],
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json"
                }
            });
        });
    </script>
    <script>
        function verEmpleado(id_Usuario) {
            window.location.href = "../Empleado/detallesEmpleado.php?mostrar=" + id_Usuario;
        }
    </script>
</body>

</html>