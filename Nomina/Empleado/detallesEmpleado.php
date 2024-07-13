<?php
require('../conexion/conexion.php');
include('../Menu.php');

$objConexion = new conexion();

if ($_GET) {
    if (isset($_GET['mostrar'])) {
        $id = $_GET['mostrar'];

        // Prevenir inyección SQL
        $id = intval($id);

        $sql = "SELECT * FROM empleado WHERE id_Usuario = $id";
        $resultado = $objConexion->consultar($sql);

        if (count($resultado) > 0) {
            $empleado = $resultado[0];
        } else {
            echo "Empleado no encontrado.";
            exit();
        }
    }
} else {
    echo "No se ha proporcionado un ID.";
    exit();
}
?>

<!doctype html>
<html lang="es">

<head>
    <title>Detalles empleados</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="../Css/empleado.css">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>



<body>
    <div class="container col-md-7">
        <div class="col-12 text-center">
        <H1 class="tituloempleado">DETALLES DEL EMPLEADO</H1>
        </div>
        <form class="row g-9">
            <?php if (isset($empleado)) : ?>
                <div class="col-12 text-center">
                    <img   width="110" height="110"  src="../fotos/<?php echo htmlspecialchars($empleado['fotoempleado']); ?>" alt="Foto del empleado">
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
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <p>No se encontró el empleado.</p>
            <?php endif; ?>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>