<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Css/empleado.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
        <H1 class="tituloempleado">Ficha Empleado</H1>
    
    <div class="container d-flex justify-content-center">
<form class="row g-3 "  >
  <div class="col-md-6" >
    <label class="form-label">Nombre:</label>
    <input type="texto" name="txtNombre" class="form-control" id="inputNombre">
  </div>
  <div class="col-md-6" >
    <label  class="form-label">Apellido:</label>
    <input type="text" name="txtApellido" class="form-control" id="inputApellido">
  </div>
  <div class="col-md-6" >
    <label class="form-label">Cédula:</label>
    <input type="text" name="txtCedula" class="form-control" id="inputCedula">
  </div>
  <div class="col-md-6" >
    <label  class="form-label">Fecha de Nacimiento:</label>
    <input type="date" name="txtFechaNacimiento" class="form-control" id="inputFechaNacimiento">
  </div>
  <div class="col-md-6" >
    <label  class="form-label">Celular:</label>
    <input type="text" name="txtCelular" class="form-control" id="inputCelular">
  </div>
  <div class="col-md-6">
    <label  class="form-label">Dirección:</label>
    <input type="text" name="txtDireccion" class="form-control" id="inputDireccion">
  </div>
  <div class="col-md-6" >
    <label  class="form-label">Email:</label>
    <input type="email" name="txtEmail" class="form-control" id="inputEmail">
  </div>
  <div class="col-md-6" >
    <label  class="form-label">Estado Civil:</label>
    <input type="text" name="txtEstadoCivil" class="form-control" id="inputEstadoCivil">
  </div>
  <div class="col-md-6" >
    <label  class="form-label">EPS:</label>
    <input type="text" name="txtEps" class="form-control" id="inputEps">
  </div>
  <div class="col-md-6" >
    <label  class="form-label">ARL:</label>
    <input type="text" name="txtArl" class="form-control" id="inputArl">
  </div>
  <div class="col-md-6">
    <label  class="form-label">Fondo de Pensiones:</label>
    <input type="text"  name="txtFondoPensiones" class="form-control" id="inputFondoPensiones">
  </div>
  <div class="col-md-6" >
    <label  class="form-label">Fondo de Cesantias:</label>
    <input type="text" name="txtFondoCesantias" class="form-control" id="inputFondoCesantias">
  </div>
  <div class="col-md-6" >
    <label class="form-label">Entidad Bancaria:</label>
    <input type="text" name="txtEntidadBancaria" class="form-control" id="inputEntidadBancaria">
  </div>
  <div class="col-md-6" >
    <label class="form-label">Número de Cuenta:</label>
    <input type="text" name="txtNumeroCuenta" class="form-control" id="inputNumeroCuenta">
  </div>
  <div class="col-md-6" >
    <label  class="form-label">Fecha Ingreso:</label>
    <input type="date" name="txtFechaIngreso" class="form-control" id="inputFechaIngreso">
  </div>
  <div class="col-md-6" >
    <label  class="form-label">Fecha terminación de Contrato:</label>
    <input type="date" name="txtFechaTerminacion" class="form-control" id="inputFechaTerminacion">
  </div>
  <div class="col-md-6" >
    <label  class="form-label">Contacto de Emergencia:</label>
    <input type="text" name="txtContacto" class="form-control" id="inputContacto">
  </div>
  <div class="col-md-6" >
    <label  class="form-label">Número Contacto de Emergencia:</label>
    <input type="text" name="txtNumeroContacto" class="form-control" id="inputNumeroContacto">
  </div>
  
  
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Agregar Registro</button>
  </div>
</form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>