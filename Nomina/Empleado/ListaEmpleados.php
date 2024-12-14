<?php
require('../conexion/conexion.php');

$objConexion = new conexion();
$resultado = $objConexion->consultar("SELECT * FROM empleado");


if (isset($_GET['borrar'])) {
    $id = $_GET['borrar'];
    $objConexion = new conexion();
    $sql = "DELETE FROM empleado WHERE id_empleado = $id";
    $objConexion->ejecutar($sql);
    header("location: ListaEmpleados.php");
    exit();
}

$SQLConfiracion = "select * from configuracion";

$StmtConfiguracion = $objConexion->prepare($SQLConfiracion);

$StmtConfiguracion->execute();

$resultadoConfiguracion = $StmtConfiguracion->fetch(PDO::FETCH_ASSOC);







include('../Menu.php');


?>


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
    <div class="container col-md-9">
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
                <?php foreach ($resultado as $empleado) {
                    $imagen = $empleado['fotoempleado'];
                    if (empty($imagen)) {
                        $imagen = '../iconos/defectos.png';
                    }
                ?>
                    <tr>
                        <td><img width="70" height="70" src="../fotos/<?php echo htmlspecialchars($imagen); ?>" alt="Foto del empleado"></td>
                        <td><?php echo htmlspecialchars($empleado['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($empleado['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($empleado['cedula']); ?></td>
                        <td><?php echo htmlspecialchars($empleado['celular']); ?></td>
                        <td>
                            <?php if (!empty($empleado['archivo'])) : ?>
                                <a href="<?php echo htmlspecialchars($empleado['archivo']); ?>">
                                    <?php
                                    $archivo = basename($empleado['archivo']);
                                    $archivo_mostrado = (strlen($archivo) > 10) ? substr($archivo, 0, 12) . '...' : $archivo;
                                    echo htmlspecialchars($archivo_mostrado);
                                    ?>
                                </a>
                            <?php endif; ?>
                        </td>
                        <td>

                            <a class="btn" title="Visualizar" data-bs-toggle="modal" data-bs-target="#employeeModal<?php echo htmlspecialchars($empleado['id_empleado']); ?>"><img src="../iconos/visualizar.png"></a>


                            <input type="hidden" name="id_empleado" value="<?php echo htmlspecialchars($empleado['id_empleado']); ?>">
                            <input type="hidden" name="id_configuracion" value="<?php echo htmlspecialchars($resultadoConfiguracion['id_configuracion']); ?>">

                            <a class="btn" title="Actualizar" href="ActualizarEmpleado.php?id=<?php echo htmlspecialchars($empleado['id_empleado']); ?>" role="button"><img src="../iconos/actualizar.jpeg"></a>

                            <a class="btn" title="Agregar Nómina" href="../Empleado/nomina.php?id=<?php echo htmlspecialchars($empleado['id_empleado']); ?>&id_configuracion=<?php echo $resultadoConfiguracion['id_configuracion']; ?>"><img src="../iconos/nomina.png"></a>

                            <a class="btn" title="Modificar Nómina" href=""><img src="../iconos/EditarNomina.png"></a>
                            <a class="btn" title="Eliminar" href="javascript:borrar(<?php echo htmlspecialchars($empleado['id_empleado']); ?>);" role="button"><img src="../iconos/delete.png"></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


    <?php foreach ($resultado as $empleado) { ?>
        <div class="modal fade" id="employeeModal<?php echo $empleado['id_empleado']; ?>" tabindex="-1" aria-labelledby="employeeModalLabel<?php echo $empleado['id_empleado']; ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="employeeModalLabel<?php echo $empleado['id_empleado']; ?>">Detalles del Empleado</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12 text-center">
                            <img width="70" height="70" src="<?php echo $empleado['fotoempleado']; ?>" alt="Foto del empleado">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td colspan="2"><strong>Nombre:</strong> &nbsp; <?php echo htmlspecialchars($empleado['nombre']); ?></td>
                                        <td colspan="2"><strong>Apellidos:</strong> &nbsp; <?php echo htmlspecialchars($empleado['apellido']); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong>Cédula:</strong> &nbsp; <?php echo htmlspecialchars($empleado['cedula']); ?></td>
                                        <td colspan="2"><strong>Fecha de Nacimiento:</strong> &nbsp; <?php echo htmlspecialchars($empleado['fechaNacimiento']); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong>Celular:</strong> &nbsp; <?php echo htmlspecialchars($empleado['celular']); ?></td>
                                        <td colspan="2"><strong>Dirección:</strong> &nbsp; <?php echo htmlspecialchars($empleado['direccion']); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong>Correo:</strong> &nbsp; <?php echo htmlspecialchars($empleado['correo']); ?></td>
                                        <td colspan="2"><strong>Estado Civil:</strong> &nbsp; <?php echo htmlspecialchars($empleado['estadoCivil']); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong>EPS:</strong> &nbsp; <?php echo htmlspecialchars($empleado['eps']); ?></td>
                                        <td colspan="2"><strong>ARL:</strong> &nbsp; <?php echo htmlspecialchars($empleado['arl']); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong>Fondo de Pensiones:</strong> &nbsp; <?php echo htmlspecialchars($empleado['fondoPensiones']); ?></td>
                                        <td colspan="2"><strong>Fondo de Cesantias:</strong> &nbsp; <?php echo htmlspecialchars($empleado['fondoCesantias']); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong>Entidad Bancaria:</strong> &nbsp; <?php echo htmlspecialchars($empleado['entidadBancaria']); ?></td>
                                        <td colspan="2"><strong>Número de Cuenta:</strong> &nbsp; <?php echo htmlspecialchars($empleado['numeroCuenta']); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong>Fecha de Ingreso:</strong> &nbsp; <?php echo htmlspecialchars($empleado['fechaIngreso']); ?></td>
                                        <td colspan="2"><strong>Fecha de Terminación de Contrato:</strong> &nbsp; <?php echo htmlspecialchars($empleado['fechaTerminacion']); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong>Contacto de Emergencia:</strong> &nbsp; <?php echo htmlspecialchars($empleado['contactoEmergencia']); ?></td>
                                        <td colspan="2"><strong>Número Contacto de Emergencia:</strong> &nbsp; <?php echo htmlspecialchars($empleado['numeroContactoEmergencia']); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><strong>Archivos Adjuntos:</strong> &nbsp;
                                            <?php if (!empty($empleado['archivo'])) : ?>
                                                <a href="<?php echo htmlspecialchars($empleado['archivo']); ?>">
                                                    <?php
                                                    $archivo = basename($empleado['archivo']);
                                                    $archivo_mostrado = (strlen($archivo) > 10) ? substr($archivo, 0, 12) . '...' : $archivo;
                                                    echo htmlspecialchars($archivo_mostrado);
                                                    ?>
                                                </a>
                                            <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>


    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/solid.js" integrity="sha384-/BxOvRagtVDn9dJ+JGCtcofNXgQO/CCCVKdMfL115s3gOgQxWaX/tSq5V8dRgsbc" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/fontawesome.js" integrity="sha384-dPBGbj4Uoy1OOpM4+aRGfAOc0W37JkROT+3uynUgTHZCHZNMHfGXsmmvYTffZjYO" crossorigin="anonymous"></script>
    <script>
        function borrar(id_empleado) {
    Swal.fire({
        title: "¿Desea borrar el registro?",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: "Si, Borrar",
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "¡Eliminado!",
                text: "El registro ha sido borrado.",
                icon: "success"
            }).then(() => {
                window.location = "ListaEmpleados.php?borrar=" + id_empleado;
            });
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
        function verEmpleado(id_empleado) {
            window.location.href = "../Empleado/detallesEmpleado.php?mostrar=" + id_empleado;
        }
    </script>
</body>

</html>