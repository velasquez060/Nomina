<?php
require('../conexion/conexion.php');
include('../Menu.php');

if (empty($_SESSION["id"])) {
    header("location: login.php");
}




$objConexion = new conexion();
$sql = "SELECT id_empleado, nombre, apellido FROM empleado";
$stmt = $objConexion->prepare($sql);
$stmt->execute();
$rowVerificar = $stmt->fetchAll(PDO::FETCH_ASSOC);



// foreach ($rowVerificar as $prueba) {
//     echo $prueba['id_empleado'] . "  " . $prueba['nombre'] . "<br>";
// }


$ID_Configuracion = isset($_GET['id_configuracion']) ? $_GET['id_configuracion'] : null;

$SQLconfiguracion = "select horas_trabajadas_diurnas,horas_extras_trabajadas_diurnas, horas_extras_trabajadas_nocturnas, horas_extras_trabajadas_dominicales_diurnas, horas_extras_trabajadas_dominicales_nocturna, horas_domingos_festivos,horas_recargo_nocturno,deduccion_horas_permisos from nomina where id_configuracion='$ID_Configuracion'";

$SMTconfiguracion = $objConexion->prepare($SQLconfiguracion);
$SMTconfiguracion->execute();



$ResultadoConfiguracion = $SMTconfiguracion->fetch(PDO::FETCH_ASSOC);

?>




<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
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
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row mb-4">
                    <div class="col text-center">
                        <h1>Registro de Nómina Diaria</h1>
                    </div>
                </div>
                <form action="nominaDiaria.php" method="post">
                    <div class="row justify-content-center">
                        <div class="col-md-3 mb-3 text-center">
                            <select name="textEstadoCivil" class="form-select mb-2" id="selectEmpleados" required>
                                <option value="">Seleccione una opción</option>
                                <option value="selecionado">Empleado Seleccionado</option>
                                <option value="todos">Todos los Empleados</option>
                            </select>
                            <?php
                            foreach ($rowVerificar as $prueba) {

                                echo "<div class='d-flex justify-content-between align-items-center mb-2'>
                                    <div>" . $prueba['nombre'] . " " . $prueba['apellido'] . "</div>
                                    <div><input type='checkbox' name='empleado_" . $prueba['id_empleado'] . "' class='empleado-checkbox'></div>
                                    </div>";
                            }
                            ?>
                        </div>
                        <div class="col-md-3 mb-3">

                            <input type="date" class="form-control" id="fechaHora" name="fechaHora">
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="row g-2">
                                <div class="col-12">
                                    <input type="number" class="form-control mb-2" value="<?php echo $ResultadoConfiguracion['horas_trabajadas_diurnas'] ?>" placeholder="Horas laboradas">
                                    <input type="number" class="form-control mb-2" value="<?php echo $ResultadoConfiguracion['horas_trabajadas_diurnas'] ?>" placeholder="Horas incapacidad">
                                    <input type="number" class="form-control mb-2" value="<?php echo $ResultadoConfiguracion['horas_extras_trabajadas_diurnas'] ?>" placeholder="Horas Extras Diurnas">
                                    <input type="number" class="form-control mb-2" value="<?php echo $ResultadoConfiguracion['horas_extras_trabajadas_nocturnas'] ?>" placeholder="Horas Extras Nocturnas">
                                    <input type="number" class="form-control mb-2" value="<?php echo $ResultadoConfiguracion['horas_extras_trabajadas_dominicales_diurnas'] ?>" placeholder="Horas Extras Dominicales">
                                    <input type="number" class="form-control mb-2" value="<?php echo $ResultadoConfiguracion['horas_extras_trabajadas_dominicales_nocturna'] ?>" placeholder="Horas Extras Dominicales Nocturnas">
                                    <input type="number" class="form-control mb-2" value="<?php echo $ResultadoConfiguracion['horas_domingos_festivos'] ?>" placeholder="Horas Domingos y Festivos">
                                    <input type="number" class="form-control mb-2" value="<?php echo $ResultadoConfiguracion['horas_recargo_nocturno'] ?>" placeholder="Recargo Nocturno">
                                    <input type="number" class="form-control mb-2" value="<?php echo $ResultadoConfiguracion['deduccion_horas_permisos '] ?>" placeholder="Horas Permiso">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="submit" class="btn btn-danger">Cancelar</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectEmpleados = document.getElementById('selectEmpleados');
            const checkboxes = document.querySelectorAll('.empleado-checkbox');

            selectEmpleados.addEventListener('change', function() {
                const selectedValue = this.value;

                if (selectedValue === 'todos') {
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = true;
                    });
                } else if (selectedValue === 'selecionado') {
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = false;
                    });
                }
            });
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
</body>

</html>