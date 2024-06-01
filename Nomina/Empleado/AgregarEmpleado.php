<?php

require('../conexion/conexion.php');
require('../Menu.php');




if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = htmlspecialchars($_POST['textNombre']); 
  $apellido = htmlspecialchars($_POST['textApellido']);
  $cedula = htmlspecialchars($_POST['textCedula']);
  $fechaNacimiento = htmlspecialchars($_POST['textFechaNacimiento']);
  $celular = htmlspecialchars($_POST['textCelular']);
  $direccion = htmlspecialchars($_POST['textDireccion']);
  $correo = htmlspecialchars($_POST['textCorreo']);
  $estadoCivil = htmlspecialchars($_POST['textEstadoCivil']);
  $eps = htmlspecialchars($_POST['textEps']);
  $arl = htmlspecialchars($_POST['textArl']);
  $fondoPensiones = htmlspecialchars($_POST['textFondoPensiones']);
  $fondoCesantias = htmlspecialchars($_POST['textFondoCesantias']);
  $entidadBancaria = htmlspecialchars($_POST['textEntidadBancaria']);
  $numeroCuenta = htmlspecialchars($_POST['textNumeroCuenta']);
  $fechaIngreso = htmlspecialchars($_POST['textFechaIngreso']);
  $fechaTerminacion = !empty($_POST['textFechaTerminacion']) ? $_POST['textFechaTerminacion'] : null;
  $contactoEmergencia = htmlspecialchars($_POST['textContacto']);
  $numeroContactoEmergencia = htmlspecialchars($_POST['textNumeroContacto']);

  if (
    !empty($nombre) && !empty($apellido) && !empty($cedula) && !empty($fechaNacimiento) &&
    !empty($celular) && !empty($direccion) && !empty($correo) && !empty($estadoCivil) && !empty($fechaIngreso) && !empty($contactoEmergencia) && !empty($numeroContactoEmergencia) 

  
    
) {

  try {

    $sql = "INSERT INTO empleado (nombre, apellido, cedula, fechaNacimiento, celular, direccion, correo, estadoCivil, eps, arl, fondoPensiones, fondoCesantias, entidadBancaria, numeroCuenta, fechaIngreso, fechaTerminacion, contactoEmergencia, numeroContactoEmergencia) VALUES (:nombre, :apellido, :cedula, :fechaNacimiento, :celular, :direccion, :correo, :estadoCivil, :eps, :arl, :fondoPensiones, :fondoCesantias, :entidadBancaria, :numeroCuenta, :fechaIngreso, :fechaTerminacion, :contactoEmergencia, :numeroContactoEmergencia)";
  
  $stmt = $conexion->prepare($sql);
  
  $stmt->bindParam(':nombre', $nombre);
  $stmt->bindParam(':apellido', $apellido);
  $stmt->bindParam(':cedula', $cedula);
  $stmt->bindParam(':fechaNacimiento', $fechaNacimiento);
  $stmt->bindParam(':celular', $celular);
  $stmt->bindParam(':direccion', $direccion);
  $stmt->bindParam(':correo', $correo);
  $stmt->bindParam(':estadoCivil', $estadoCivil);
  $stmt->bindParam(':eps', $eps);
  $stmt->bindParam(':arl', $arl);
  $stmt->bindParam(':fondoPensiones', $fondoPensiones);
  $stmt->bindParam(':fondoCesantias', $fondoCesantias);
  $stmt->bindParam(':entidadBancaria', $entidadBancaria);
  $stmt->bindParam(':numeroCuenta', $numeroCuenta);
  $stmt->bindParam(':fechaIngreso', $fechaIngreso);
  $stmt->bindParam(':fechaTerminacion', $fechaTerminacion);
  $stmt->bindParam(':contactoEmergencia', $contactoEmergencia);
  $stmt->bindParam(':numeroContactoEmergencia', $numeroContactoEmergencia);
  
  
  
      $stmt->execute();
  
  
      if ($stmt->rowCount() > 0) {
        echo "<script>alert('Usuario Agregado Correctamente');</script>";

        header("Location: AgregarEmpleado.php");
        
      }
    
  } catch (Exception $e) {
    echo $e->getMessage();
  }finally{
    
    $stmt->close();
    $conexion->close();

  }
    
} else {
  echo "<script>alert('por favor rellene todos los campos');</script>";
}
} else {
  //echo "No se recibieron datos del formulario.";

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Css/empleado.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="../js/validacionCampos.js"></script>
  <title>Document</title>
  
</head>

<body>

  <H1 class="tituloempleado">FICHA EMPLEADO</H1>
  <br>
  <div class="container col-md-9">
    <form class="row g-3 prueba" action="AgregarEmpleado.php" method="POST" autocomplete="on" >
      <div class="col-md-6">
        <label class="form-label">Nombre:</label>
        <input type="texto" name="textNombre" class="form-control" id="inputNombre">
      </div>
      <div class="col-md-6">
        <label class="form-label">Apellido:</label>
        <input type="text" name="textApellido" class="form-control" id="inputApellido">
      </div>
      <div class="col-md-6">
        <label class="form-label">Cédula:</label>
        <input type="text" name="textCedula" class="form-control" id="numeroEntero_1" oninput="validarNumeroEntero('numeroEntero_1')">
        <p id="mensajeError_1"></p>
      </div>
      <div class="col-md-6">
        <label class="form-label">Fecha de Nacimiento:</label>
        <input type="date" name="textFechaNacimiento" class="form-control" id="inputFechaNacimiento">
      </div>
      <div class="col-md-6">
        <label class="form-label">Celular:</label>
        <input type="text" name="textCelular" class="form-control" id="numeroEntero_2" oninput="validarNumeroEntero('numeroEntero_2')" >
        <p id="mensajeError_2"></p>
      </div>
      <div class="col-md-6">
        <label class="form-label">Dirección:</label>
        <input type="text" name="textDireccion" class="form-control" id="inputDireccion">
      </div>
      <div class="col-md-6">
        <label class="form-label">Correo:</label>
        <input type="email" name="textCorreo" class="form-control" id="inputCorreo">
      </div>
      <div class="col-md-6">
        <label class="form-label">Estado Civil:</label>
        <input type="text" name="textEstadoCivil" class="form-control" id="inputEstadoCivil">
      </div>
      <div class="col-md-6">
        <label class="form-label">EPS:</label>
        <input type="text" name="textEps" class="form-control" id="inputEps">
      </div>
      <div class="col-md-6">
        <label class="form-label">ARL:</label>
        <input type="text" name="textArl" class="form-control" id="inputArl">
      </div>
      <div class="col-md-6">
        <label class="form-label">Fondo de Pensiones:</label>
        <input type="text" name="textFondoPensiones" class="form-control" id="inputFondoPensiones">
      </div>
      <div class="col-md-6">
        <label class="form-label">Fondo de Cesantias:</label>
        <input type="text" name="textFondoCesantias" class="form-control" id="inputFondoCesantias">
      </div>
      <div class="col-md-6">
        <label class="form-label">Entidad Bancaria:</label>
        <input type="text" name="textEntidadBancaria" class="form-control" id="inputEntidadBancaria">
      </div>
      <div class="col-md-6">
        <label class="form-label">Número de Cuenta:</label>
        <input type="text" name="textNumeroCuenta" class="form-control" id="numeroEntero_3" oninput="validarNumeroEntero('numeroEntero_3')">
        <p id="mensajeError_3"></p>
      </div>
      <div class="col-md-6">
        <label class="form-label">Fecha Ingreso:</label>
        <input type="date" name="textFechaIngreso" class="form-control" id="inputFechaIngreso">
      </div>
      <div class="col-md-6">
        <label class="form-label">Fecha terminación de Contrato:</label>
        <input type="date" name="textFechaTerminacion" class="form-control">
      </div>
      <div class="col-md-6">
        <label class="form-label">Contacto de Emergencia:</label>
        <input type="text" name="textContacto" class="form-control" id="inputContacto">
      </div>
      <div class="col-md-6">
        <label class="form-label">Número Contacto de Emergencia:</label>
        <input type="text" name="textNumeroContacto" class="form-control" id="numeroEntero_4" oninput="validarNumeroEntero('numeroEntero_4')">
        <p id="mensajeError_4"></p>
      </div>


      <div class="col-12">
        <button type="submit" class="btn btn-primary" value="Registrar"  name="registrar" id="registrar" onclick="prueba">Registrar</button>
      </div>
      
    
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>