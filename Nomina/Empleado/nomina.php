<?php
include("../Menu.php");
require('../conexion/conexion.php');
$objconexion = new conexion();



$ID_Empleado = $_GET["id"];
$TernarioEmpleado = $ID_Empleado != "" ?  "el ID del Empeado es " . $ID_Empleado : "Hubo un error al capturar el ID del Empleado";
echo $TernarioEmpleado;
echo "<br>";
$ID_Configuracion = $_GET["id_configuracion"];
$TernarioConfiguracion = $ID_Configuracion != "" ?  "el ID de la Configuracion es " . $ID_Configuracion : "Hubo un error al capturar el ID de la Configuracion";
echo $TernarioConfiguracion;

$SQLEmpleado = "select id_empleado,nombre,apellido,cedula from empleado where id_empleado='$ID_Empleado'";

$SMTEmpleado = $objconexion->prepare($SQLEmpleado);
$SMTEmpleado->execute();

$ResultadoEmpleado = $SMTEmpleado->fetch(PDO::FETCH_ASSOC);

#prueba
$SQLconfiguracion = "select nombre_empresa,salario_basico,valor_hora,valor_hora_extra_diurna,valor_hora_extra_nocturna,valor_hora_extra_dominical,valor_hora_extra_dominical_nocturna,valor_hora_domingos_festivos,valor_recargo_nocturno,valor_auxilio_transporte,valor_salud,valor_pension from configuracion where id_configuracion='$ID_Configuracion'";

$SMTconfiguracion = $objconexion->prepare($SQLconfiguracion);
$SMTconfiguracion->execute();

$ResultadoConfiguracion = $SMTconfiguracion->fetch(PDO::FETCH_ASSOC);










?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
</head>

<body>
    <div class="container">
        <div class="row mb-4">
            <div class="col text-center">
                <h1 class="text-center">Registrar Nómina</h1>
            </div>
        </div>
        <br>
        <form action="">
            <div class="informacion">

                <div class="row mb-1">
                    <div class="col-md-2 mb-3 mb-md-0">
                        <label for="nombre" class="form-label">Nombre Completo:</label>
                        <input type="text" name="nombre" class="form-control form-control-xs" value="<?php echo $ResultadoEmpleado['nombre'] . ' ' . $ResultadoEmpleado['apellido'];?> ">
                    </div>
                    <div class="col-md-2 mb-3 mb-md-0">
                        <label for="nombre" class="form-label">Cedúla:</label>
                        <input type="text" name="nombre" class="form-control form-control-xs" value="<?php echo $ResultadoEmpleado['cedula'];?>" disabled>
                    </div>
                    <div class="col-md-2 mb-3 mb-md-0">
                        <label for="nombre" class="form-label">Empresa:</label>
                        <input type="text" name="nombre" class="form-control form-control-xs" value="<?php echo $ResultadoConfiguracion['nombre_empresa'] ?>">
                    </div>
                    <div class="col-md-2 mb-3 mb-md-0">
                        <label for="nombre" class="form-label">Salario:</label>
                        <input type="text" name="nombre" class="form-control form-control-xs" value="<?php echo $ResultadoConfiguracion['salario_basico'] ?>">
                    </div>
                    <div class="col-md-2 mb-3 mb-md-0">
                        <label for="nombre" class="form-label">Fecha Inicial:</label>
                        <input type="date" name="nombre" class="form-control form-control-xs">
                    </div>
                    <div class="col-md-2 mb-3 mb-md-0">
                        <label for="nombre" class="form-label">Fecha Final:</label>
                        <input type="date" name="nombre" class="form-control form-control-xs">
                    </div>
                </div>
            </div>
            <br>
            <hr>
            <div class="row mb-1">
                <div class="col-md-3 mb-3 mb-md-0">
                    <label for="nombre" class="form-label fw-bold">Conceptos:</label>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <label for="nombre" class="form-label fw-bold">Total Horas:</label>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <label for="nombre" class="form-label fw-bold">Valor Hora:</label>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <label for="nombre" class="form-label fw-bold">Total:</label>
                </div>

            </div>
            <div class="row mb-1">
                <div class="col-md-3 mb-3 mb-md-0">
                    <label for="nombre" class="form-label">Valor Dia:</label>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs" value="<?php echo $ResultadoConfiguracion['valor_hora'] ?>">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-3 mb-3 mb-md-0">
                    <label for="nombre" class="form-label">Incapacidad:</label>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs" value="<?php echo $ResultadoConfiguracion['valor_hora'] ?>">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-3 mb-3 mb-md-0">
                    <label for="nombre" class="form-label">Horas Extras Diurnas:</label>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs" value="<?php echo $ResultadoConfiguracion['valor_hora_extra_diurna'] ?>">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-3 mb-3 mb-md-0">
                    <label for="nombre" class="form-label">Horas Extras Nocturnas:</label>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs" value="<?php echo $ResultadoConfiguracion['valor_hora_extra_nocturna'] ?>">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-3 mb-3 mb-md-0">
                    <label for="nombre" class="form-label">Horas Extras Dominicales Diurnas:</label>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs" value="<?php echo $ResultadoConfiguracion['valor_hora_extra_dominical'] ?>">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-3 mb-3 mb-md-0">
                    <label for="nombre" class="form-label">Horas Extras Dominicales Nocturnas:</label>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs" value="<?php echo $ResultadoConfiguracion['valor_hora_extra_dominical_nocturna'] ?>">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-3 mb-3 mb-md-0">
                    <label for="nombre" class="form-label">Domingos y Festivos (Horas):</label>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs" value="<?php echo $ResultadoConfiguracion['valor_hora_domingos_festivos'] ?>">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-3 mb-3 mb-md-0">
                    <label for="nombre" class="form-label">Recargo Nocturno:</label>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs" value="<?php echo $ResultadoConfiguracion['valor_recargo_nocturno'] ?>">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
            </div>
            <hr>
            <div class="row mb-1">
                <div class="col-md-9 mb-3 mb-md-0">
                    <label for="nombre" class="form-label fw-bold">Subtotal:</label>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-9 mb-3 mb-md-0">
                    <label for="nombre" class="form-label fw-bold">Subtotal Horas Extras:</label>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-3 mb-3 mb-md-0">
                    <label for="nombre" class="form-label">Auxilio de transporte (Días laborados):</label>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs" value="<?php echo $ResultadoConfiguracion['valor_auxilio_transporte'] ?>">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-9 mb-3 mb-md-0">
                    <label for="nombre" class="form-label">Prestamos:</label>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs" >
                </div>
            </div>
            <hr>
            <div class="row mb-1">
                <div class="col-md-9 mb-3 mb-md-0">
                    <label for="nombre" class="form-label fw-bold">Total Devengado:</label>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col text-center">
                    <h4 class="text-center fw-bold">Deducciones:</h4>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-9 mb-3 mb-md-0">
                    <label for="nombre" class="form-label">Aporte a Salud:</label>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs" value="<?php echo $ResultadoConfiguracion['valor_salud'] ?>">
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-9 mb-3 mb-md-0">
                    <label for="nombre" class="form-label">Aporte a Pensión:</label>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs" value="<?php echo $ResultadoConfiguracion['valor_pension'] ?>"> 
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-9 mb-3 mb-md-0">
                    <label for="nombre" class="form-label">Deducción Prestamo:</label>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-3 mb-3 mb-md-0">
                    <label for="nombre" class="form-label">Deducción de Horas Permisos:</label>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-9 mb-3 mb-md-0">
                    <label for="nombre" class="form-label fw-bold">Subtotal Deducciones:</label>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
            </div>
            <hr>
            <div class="row mb-1">
                <div class="col-md-9 mb-3 mb-md-0">
                    <label for="nombre" class="form-label fw-bold">TOTAL A PAGAR:</label>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="nombre" class="form-control form-control-xs">
                </div>
            </div>
            <br>
            <div class="row mb-1 justify-content-center align-items-center">
                <div class="col-md-4 mb-3 mb-md-0 ">
                    <button type="button" class="btn btn-primary">Calcular</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-danger">Eliminar</button>
                    <a href="./ListaEmpleados.php" class="btn btn-danger">Cancelar</a>

                </div>

            </div>
    </div>
</body>

</html>