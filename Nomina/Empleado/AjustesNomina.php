<?php
include("../Menu.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
$salariobasico = $_GET["salarioBasico"];
$valorhora= $_GET["valorHora"];
$valorHoraExtraDiurna = $_GET["valorHoraExtraDiurna"];
$valorHoraExtraNocturna = $_GET["valorHoraExtraNocturna"];
$valorHoraExtraDominical = $_GET["valorHoraExtraDominical"];
$valorHoraExtraDominicalNocturna = $_GET["valorHoraExtraDominicalNocturna"];
$valorHoraDomingosFestivos = $_GET["valorHoraDomingosFestivos"];
$valorRecargoNocturno = $_GET["valorRecargoNocturno"];
$valorAuxilioTransporte = $_GET["valorAuxilioTransporte"];
$valorSalud = $_GET["valorSalud"];
$valorPension = $_GET["valorPension"];


if(!empty($salariobasico) && !empty($valorhora) && !empty($valorHoraExtraDiurna) && !empty($valorHoraExtraNocturna)){

}else{
    echo "<script>alert('por favor rellenar todos los campos!!!!!');</script>";
}

}










?>
<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"/>
        <link rel="stylesheet" href="../Css/ajustesNomina.css">    

    </head>

    <body>
       
    <div class="container">
  <div class="row mb-4">
    <div class="col text-center">
      <h1>Configuraciones Nomina</h1>
    </div>
  </div>
  <form action="AjustesNomina.php" method="post">
    <div class="row mb-1">
      <div class="col-md-6 mb-3 mb-md-0">
        <label for="salarioBasico" class="form-label">Salario Basico:</label>
        <input type="text" name="salarioBasico" class="form-control" id="numeroEntero_1" oninput="validarNumeroEntero('numeroEntero_1')" required>
        <p id="mensajeError_1"></p>
      </div>
      <div class="col-md-6">
        <label for="valorHora" class="form-label">Valor Hora:</label>
        <input type="text" name="valorHora" class="form-control" id="numeroEntero_2" oninput="validarNumeroEntero('numeroEntero_2')"required>
        <p id="mensajeError_2"></p>
      </div>
    </div>
    <div class="row mb-1">
      <div class="col-md-6 mb-3 mb-md-0">
        <label for="valorHoraExtraDiurna" class="form-label">Valor Hora Extra Diurna:</label>
        <input type="text" name="valorHoraExtraDiurna" class="form-control" id="numeroEntero_3" oninput="validarNumeroEntero('numeroEntero_3')"required>
        <p id="mensajeError_3"></p>
      </div>
      <div class="col-md-6">
        <label for="valorHoraExtraNocturna" class="form-label">Valor Hora Extra Nocturna:</label>
        <input type="text" name="valorHoraExtraNocturna" class="form-control" id="numeroEntero_4" oninput="validarNumeroEntero('numeroEntero_4')"required >
        <p id="mensajeError_4"></p>
      </div>
    </div>
    <div class="row mb-1">
      <div class="col-md-6 mb-3 mb-md-0">
        <label for="valorHoraExtraDominical" class="form-label">Valor Hora Extra Dominical:</label>
        <input type="text" name="valorHoraExtraDominical" class="form-control" id="numeroEntero_5" oninput="validarNumeroEntero('numeroEntero_5')"required>
        <p id="mensajeError_5"></p>
      </div>
      <div class="col-md-6">
        <label for="valorHoraExtraDominicalNocturna" class="form-label">Valor Hora Extra Dominical Nocturna:</label>
        <input type="text" name="valorHoraExtraDominicalNocturna" class="form-control" id="numeroEntero_6" oninput="validarNumeroEntero('numeroEntero_6')"required>
        <p id="mensajeError_6"></p>
      </div>
    </div>
    <div class="row mb-1">
      <div class="col-md-6 mb-3 mb-md-0">
        <label for="valorHoraDomingosFestivos" class="form-label">Valor Hora Domingos y Festivos:</label>
        <input type="text" name="valorHoraDomingosFestivos" class="form-control" id="numeroEntero_7" oninput="validarNumeroEntero('numeroEntero_7')"required>
        <p id="mensajeError_7"></p>
      </div>
      <div class="col-md-6">
        <label for="valorRecargoNocturno" class="form-label">Valor Recargo Nocturno:</label>
        <input type="text" name="valorRecargoNocturno" class="form-control" id="numeroEntero_8" oninput="validarNumeroEntero('numeroEntero_8')"required>
        <p id="mensajeError_8"></p>
      </div>
    </div>
    <div class="row mb-1">
      <div class="col-md-6 mb-3 mb-md-0">
        <label for="valorAuxilioTransporte" class="form-label">Valor Auxilio de transporte:</label>
        <input type="text" name="valorAuxilioTransporte" class="form-control" id="numeroEntero_9" oninput="validarNumeroEntero('numeroEntero_9')"required>
        <p id="mensajeError_9"></p>
      </div>
      <div class="col-md-6">
        <label for="valorSalud" class="form-label">Valor Salud:</label>
        <input type="text" name="valorSalud" class="form-control" id="numeroEntero_10" oninput="validarNumeroEntero('numeroEntero_10')"required>
        <p id="mensajeError_10"></p>
      </div>
    </div>
    <div class="row mb-1">
      <div class="col-md-6 mb-3 mb-md-0">
        <label for="valorPension" class="form-label">Valor Pensión:</label>
        <input type="text" name="valorPension" class="form-control" id="numeroEntero_11" oninput="validarNumeroEntero('numeroEntero_11')"required>
        <p id="mensajeError_11"></p>
      </div>
      <div class="col-md-6 mb-3 mb-md-0">
        <label for="salarioBasico" class="form-label">Ajuste porcentual:</label>
        <input type="text" name="salarioBasico" class="form-control">
      </div>
    </div>
    <div class="row">
      <div class="col-12 text-start">
        <button type="submit" class="btn btn-primary add me-2">Guardar</button>
        <a href="../Empleado/ListaEmpleados.php" class="btn btn-danger cancel">Cancelar</a>
      </div>
    </div>
    </div>
  </form>
</div>
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"></script>

        <script src="../js/validacionCampos.js"></script>    
    </body>
</html>
