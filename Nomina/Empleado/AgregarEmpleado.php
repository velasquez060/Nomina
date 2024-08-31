<?php

require('../conexion/conexion.php');
include('../Menu.php');

$objconexion = new conexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = htmlspecialchars(ucwords($_POST['textNombre']));
  $apellido = htmlspecialchars(ucwords($_POST['textApellido']));
  $cedula = htmlspecialchars($_POST['textCedula']);
  $fechaNacimiento = htmlspecialchars($_POST['textFechaNacimiento']);
  $celular = htmlspecialchars($_POST['textCelular']);
  $direccion = htmlspecialchars(ucwords($_POST['textDireccion']));
  $correo = htmlspecialchars($_POST['textCorreo']);
  $estadoCivil = htmlspecialchars(ucwords($_POST['textEstadoCivil']));
  $eps = htmlspecialchars(ucwords($_POST['textEps']));
  $arl = htmlspecialchars(ucwords($_POST['textArl']));
  $fondoPensiones = htmlspecialchars(ucwords($_POST['textFondoPensiones']));
  $fondoCesantias = htmlspecialchars(ucwords($_POST['textFondoCesantias']));
  $entidadBancaria = htmlspecialchars(ucwords($_POST['textEntidadBancaria']));
  $numeroCuenta = htmlspecialchars($_POST['textNumeroCuenta']);
  $fechaIngreso = htmlspecialchars($_POST['textFechaIngreso']);
  $fechaTerminacion = !empty($_POST['textFechaTerminacion']) ? $_POST['textFechaTerminacion'] : null;
  $contactoEmergencia = htmlspecialchars(ucwords($_POST['textContacto']));
  $numeroContactoEmergencia = htmlspecialchars($_POST['textNumeroContacto']);

  $imagen_por_defecto = '../iconos/defectos.png';

  // Verificar si se ha subido una imagen
  if (!empty($_FILES['imagen']['name'])) {
      $imagen = $_FILES['imagen']['name'];
      $imagen_tmp = $_FILES['imagen']['tmp_name'];
      $ruta_imagen = '../fotos/' . $imagen;
  
      // Mover la imagen subida a la carpeta de destino
      move_uploaded_file($imagen_tmp, $ruta_imagen);
  } else {
      // Asignar la imagen por defecto si no se sube ninguna imagen
      $imagen = $imagen_por_defecto;
  }
  
  // Guardar la ruta de la imagen en la base de datos o utilizarla en el código
  echo 'Ruta de la imagen: ' . $imagen;

  if (isset($_FILES["archivo"]) && $_FILES["archivo"]["error"] == UPLOAD_ERR_OK) {
    $archivo = $_FILES["archivo"]["name"];
    $archivo_temp = $_FILES["archivo"]["tmp_name"];
    $ruta_archivo = '../archivosPdf/' . $archivo;

    if (move_uploaded_file($archivo_temp, $ruta_archivo)) {
      // Código para mostrar el archivo en la interfaz
      $proyecto['archivo'] = $ruta_archivo;
    } else {
      // Manejar el error si el archivo no se puede mover
      $proyecto['archivo'] = '';
    }
  } else {
    // Si no se carga un archivo, asegúrate de que la variable esté vacía
    $proyecto['archivo'] = '';
  }

  if (
    !empty($nombre) && !empty($apellido) && !empty($cedula) && !empty($fechaNacimiento) &&
    !empty($celular) && !empty($direccion) && !empty($correo) && !empty($estadoCivil) && !empty($fechaIngreso) && !empty($contactoEmergencia) && !empty($numeroContactoEmergencia)
  ) {
    try {
      // Verificar si la cédula ya existe
      $sql_verificar = "SELECT COUNT(*) as count FROM empleado WHERE cedula = :cedula";
      $stmt_verificar = $objconexion->prepare($sql_verificar);
      $stmt_verificar->bindParam(':cedula', $cedula);
      $stmt_verificar->execute();
      $row_verificar = $stmt_verificar->fetch(PDO::FETCH_ASSOC);

      if ($row_verificar['count'] > 0) {
        echo "<script>alert('El número de cédula ya existe.');</script>";
      } else {
        // Insertar nuevo registro
        $sql = "INSERT INTO empleado (nombre, apellido, cedula, fechaNacimiento, celular, direccion, correo, estadoCivil, eps, arl, fondoPensiones, fondoCesantias, entidadBancaria, numeroCuenta, fechaIngreso, fechaTerminacion, contactoEmergencia, numeroContactoEmergencia, archivo, fotoempleado) VALUES (:nombre, :apellido, :cedula, :fechaNacimiento, :celular, :direccion, :correo, :estadoCivil, :eps, :arl, :fondoPensiones, :fondoCesantias, :entidadBancaria, :numeroCuenta, :fechaIngreso, :fechaTerminacion, :contactoEmergencia, :numeroContactoEmergencia, :archivo, :fotoempleado)";

        $stmt = $objconexion->prepare($sql);
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
        $stmt->bindParam(':archivo', $ruta_archivo);
        $stmt->bindParam(':fotoempleado', $ruta_imagen);

        if ($stmt->execute()) {
          echo "<script>alert('Usuario Agregado Correctamente');</script>";
          header("Location: ListaEmpleados.php");
        } else {
          echo "Error al agregar empleado.";
        }
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    } finally {
      $stmt_verificar = null;
      $stmt = null;
      $objconexion = null;
    }
  } else {
    echo "<script>alert('Por favor rellene todos los campos');</script>";
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="sweetalert2/dist/sweetalert2.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../Css/menu.css">
  <title>Document</title>

</head>

<body>

  <div class="titulo">
    <H1 class="tituloempleado">FICHA EMPLEADO</H1>
    <br>
    <div class="contenedorfoto">
  
    <div class="circle-container" id="preview"></div>
  </div>
</div>
  </div>

  <div class="container col-md-8">


    <form class="row g-3 prueba needs-validation" novalidate id="formulario" action="AgregarEmpleado.php" method="post" autocomplete="on" enctype="multipart/form-data" onsubmit="return validarFormulario();">
    <div>  
    <button  type="button" class="file-button" id="file-button" name="imagen" title="Editar Foto"><img src="../iconos/editarFoto.png" alt=""></button>
    <input type="file" id="file-upload" class="hidden-file-input" name="imagen">  
    </div >

      <p>Todos campos con &nbsp;<span style="color: red;">*</span>&nbsp; son de carácter obligatorio. </p>

      <div class="col-md-6">
        <label class="form-label">Nombre: <span style="color: red;">*</span></label>
        <input type="texto" name="textNombre" class="form-control" id="inputNombre" required>
        <div class="invalid-feedback">Por favor ingrese Nombre.</div>
      </div>
      <div class="col-md-6">
        <label class="form-label">Apellidos: <span style="color: red;">*</span></label>
        <input type="text" name="textApellido" class="form-control" id="inputApellido" required>
        <div class="invalid-feedback">Por favor ingrese Apellido.</div>
      </div>
      <div class="col-md-6">
        <label class="form-label">Cédula:<span style="color: red;">*</span></label>
        <input type="text" name="textCedula" class="form-control" id="numeroEntero_1" oninput="validarNumeroEntero('numeroEntero_1')" required>
        <div class="invalid-feedback">Por favor ingrese el Número de Cédula.</div>
        <p id="mensajeError_1"></p>
      </div>
      <div class="col-md-6">
        <label class="form-label">Fecha de Nacimiento:<span style="color: red;">*</span></label>
        <input type="date" name="textFechaNacimiento" class="form-control" id="inputFechaNacimiento" required>
        <div class="invalid-feedback">Por favor ingrese la Fecha de Nacimiento.</div>
      </div>
      <div class="col-md-6">
        <label class="form-label">Celular: <span style="color: red;">*</span></label>
        <input type="text" name="textCelular" class="form-control" id="numeroEntero_2" oninput="validarNumeroEntero('numeroEntero_2')" required>
        <div class="invalid-feedback">Por favor ingrese el Número de Celular.</div>
        <p id="mensajeError_2"></p>
      </div>
      <div class="col-md-6">
        <label class="form-label">Dirección: <span style="color: red;">*</span></label>
        <input type="text" name="textDireccion" class="form-control" id="inputDireccion" required>
        <div class="invalid-feedback">Por favor ingrese la Dirección.</div>
      </div>
      <div class="col-md-6">
        <label class="form-label">Correo: <span style="color: red;">*</span></label>
        <input type="email" name="textCorreo" class="form-control" id="inputCorreo" required>
        <div class="invalid-feedback">Por favor ingrese el Correo.</div>
      </div>
      <div class="col-md-6">
        <label class="form-label">Estado Civil: <span style="color: red;">*</span></label>
        <input type="text" name="textEstadoCivil" class="form-control" id="inputEstadoCivil" required>
        <div class="invalid-feedback">Por favor ingrese Estado Civil.</div>
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
        <input type="text" name="textNumeroCuenta" class="form-control" id="numeroEntero_3">
        <p id="mensajeError_3"></p>
      </div>
      <div class="col-md-6">
        <label class="form-label">Fecha Ingreso:<span style="color: red;">*</span></label>
        <input type="date" name="textFechaIngreso" class="form-control" id="inputFechaIngreso" required>
        <div class="invalid-feedback">Por favor ingrese la Fecha de Ingreso.</div>
      </div>
      <div class="col-md-6">
        <label class="form-label">Fecha terminación de Contrato:</label>
        <input type="date" name="textFechaTerminacion" class="form-control">
      </div>
      <div class="col-md-6">
        <label class="form-label">Contacto de Emergencia: <span style="color: red;">*</span></label>
        <input type="text" name="textContacto" class="form-control" id="inputContacto" required>
        <div class="invalid-feedback">Por favor ingrese el Nombre de contacto.</div>
      </div>
      <div class="col-md-6">
        <label class="form-label">Número Contacto de Emergencia:<span style="color: red;">*</span> </label>
        <input type="text" name="textNumeroContacto" class="form-control" id="numeroEntero_4" oninput="validarNumeroEntero('numeroEntero_4')" required>
        <div class="invalid-feedback">Por favor ingrese el Número de contacto.</div>
        <p id="mensajeError_4"></p>
      </div>


      <div class="col-12">

        <br>

        <input class="form-control" type="file" name="archivo" id="">
        <br>
        <br>
        <button type="submit" class="btn btn-primary" value="Registrar" name="registrar" id="registrar" onclick="prueba">Registrar</button>
      </div>


    </form>
  </div>
  <div id="alerta" class="alert"></div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


  <script src="../js/menu.js"></script>
  <script src="../js/validacionCampos.js"></script>


</body>

</html>