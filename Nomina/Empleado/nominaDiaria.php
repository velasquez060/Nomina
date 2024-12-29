<?php
require('../conexion/conexion.php');
include('../Menu.php');

if (empty($_SESSION["id"])) {
    header("location: login.php");
}


$objConexion = new conexion();
$sql = "SELECT id_empleado, nombre FROM empleado";
$stmt = $objConexion->prepare($sql);
$stmt->execute();
$rowVerificar = $stmt->fetchAll(PDO::FETCH_ASSOC);

// foreach ($rowVerificar as $prueba) {
//     echo $prueba['id_empleado'] . "  " . $prueba['nombre'] . "<br>";
// }

// $prueba = '<input type="checkbox" name="" id="">';
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
                <form action="AjustesNomina.php" method="post">
                    <div class="row justify-content-center">
                        <div class="col-md-3 mb-3">
                            <label for="nombre" class="form-label fw-bold"><?php foreach ($rowVerificar as $prueba) {
                                                                                echo $prueba['id_empleado'] . "  " . $prueba['nombre'] . '<input type="checkbox" name="" id="">'."<br>";
                                                                            } ?></label>
                            

                        </div>
                        <div class="col-md-3 mb-3">
                            <select name="textEstadoCivil" class="form-select mb-2" id="" required>
                                <option value="">Seleccione una opción</option>
                                <option value="selecionado">Empleado Seleccionado</option>
                                <option value="todos">Todos los Empleados</option>
                            </select>
                            <input type="date" class="form-control" id="fechaHora" name="fechaHora">
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="row g-2">
                                <div class="col-12">
                                    <input type="text" class="form-control mb-2" placeholder="Horas laboradas">
                                    <input type="text" class="form-control mb-2" placeholder="Horas incapacidad">
                                    <input type="text" class="form-control mb-2" placeholder="Horas Extras Diurnas">
                                    <input type="text" class="form-control mb-2" placeholder="Horas Extras Nocturnas">
                                    <input type="text" class="form-control mb-2" placeholder="Horas Extras Dominicales">
                                    <input type="text" class="form-control mb-2" placeholder="Horas Extras Dominicales Nocturnas">
                                    <input type="text" class="form-control mb-2" placeholder="Horas Domingos y Festivos">
                                    <input type="text" class="form-control mb-2" placeholder="Recargo Nocturno">
                                    <input type="text" class="form-control mb-2" placeholder="Horas Permiso">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="submit" class="btn btn-danger">Cancelar</button>
        </div>
    </div>
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