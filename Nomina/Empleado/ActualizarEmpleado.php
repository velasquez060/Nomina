<?php
require('../conexion/conexion.php');
//include('../Menu.php');

$IdUsuario = $_POST['id_Usuario'] ?? $_GET['id'] ?? null;

if ($IdUsuario === null) {
    die("Error: No se proporcionó un ID de usuario válido.");
}


$conexion = new conexion();

try {
    $sql = "SELECT e.Id_Usuario, e.nombre, e.apellido, e.cedula, e.fechaNacimiento, e.celular, e.direccion, e.correo, e.estadoCivil,
       e.eps, e.arl, e.fondopensiones, e.fondocesantias, e.entidadBancaria, e.numeroCuenta, e.fechaIngreso,
       e.fechaTerminacion, e.ContactoEmergencia, e.numeroContactoEmergencia, e.archivo, e.fotoempleado
    FROM empleado e
    WHERE e.Id_Usuario = :idUsuario";

    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':idUsuario', $IdUsuario, PDO::PARAM_INT);
    $stmt->execute();
    $empleado = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$empleado) {
        echo "No se encontraron resultados";
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $sqlUpdate = "UPDATE empleado SET 
            nombre = :nombre, apellido = :apellido, cedula = :cedula, fechaNacimiento = :fechaNacimiento, 
            celular = :celular, direccion = :direccion, correo = :correo, estadoCivil = :estadoCivil, 
            eps = :eps, arl = :arl, fondopensiones = :fondoPensiones, fondocesantias = :fondoCesantias, 
            entidadBancaria = :entidadBancaria, numeroCuenta = :numeroCuenta, fechaIngreso = :fechaIngreso, 
            fechaTerminacion = :fechaTerminacion, ContactoEmergencia = :contactoEmergencia, numeroContactoEmergencia = :numeroContactoEmergencia,
            archivo = :archivo, fotoempleado = :fotoempleado
            WHERE Id_Usuario = :idUsuario";

        $stmt2 = $conexion->prepare($sqlUpdate);

        $stmt2->bindParam(':nombre', $_POST['textNombre']);
        $stmt2->bindParam(':apellido', $_POST['textApellido']);
        $stmt2->bindParam(':cedula', $_POST['textCedula']);
        $stmt2->bindParam(':fechaNacimiento', $_POST['textFechaNacimiento']);
        $stmt2->bindParam(':celular', $_POST['textCelular']);
        $stmt2->bindParam(':direccion', $_POST['textDireccion']);
        $stmt2->bindParam(':correo', $_POST['textCorreo']);
        $stmt2->bindParam(':estadoCivil', $_POST['textEstadoCivil']);
        $stmt2->bindParam(':eps', $_POST['textEps']);
        $stmt2->bindParam(':arl', $_POST['textArl']);
        $stmt2->bindParam(':fondoPensiones', $_POST['textFondoPensiones']);
        $stmt2->bindParam(':fondoCesantias', $_POST['textFondoCesantias']);
        $stmt2->bindParam(':entidadBancaria', $_POST['textEntidadBancaria']);
        $stmt2->bindParam(':numeroCuenta', $_POST['textNumeroCuenta']);
        $stmt2->bindParam(':fechaIngreso', $_POST['textFechaIngreso']);
        $stmt2->bindParam(':fechaTerminacion', $fechaTerminacion, PDO::PARAM_STR);
        $stmt2->bindParam(':contactoEmergencia', $_POST['textContacto']);
        $stmt2->bindParam(':numeroContactoEmergencia', $_POST['textNumeroContacto']);
        
        
        $ruta_archivo = $empleado['archivo']; 
        if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
            $ruta_archivo = '../archivosPdf/' . basename($_FILES['archivo']['name']);
            move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta_archivo);
        }
        $stmt2->bindParam(':archivo', $ruta_archivo);

        $ruta_imagen = $empleado['fotoempleado']; 
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
            $ruta_imagen = '../fotos/' . basename($_FILES['imagen']['name']);
            move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen);
        }
        $stmt2->bindParam(':fotoempleado', $ruta_imagen);

        $stmt2->bindParam(':idUsuario', $IdUsuario, PDO::PARAM_INT);

        $resultado = $stmt2->execute();

        if ($resultado) {
            //echo "<script>alert('Actualizacion de Empleado Exitosa');</script>";
        
            header("Location: ListaEmpleados.php");
        } else {
            echo "Error en la actualización";
        }

    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
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
    <H1 class="tituloempleado">Actualización Ficha Empleado</H1>
    <br>
    <div class="contenedorfoto">
      <div class="circle-container" id="preview"></div>
      
    </div>
  </div>

  <div class="container col-md-8">
    <form class="row g-3 needs-validation" novalidate id="formulario" action="ActualizarEmpleado.php" method="POST" autocomplete="on" enctype="multipart/form-data" onsubmit="return validarFormulario();">
      <div>
        <input type="file" name="imagen" id="fileInput">
      </div>
      <p>Todos campos con &nbsp;<span style="color: red;">*</span>&nbsp; son de carácter obligatorio. </p>

      <div class="col-md-6">
        <label class="form-label">Nombre: <span style="color: red;">*</span></label>
        <input type="texto" name="textNombre" class="form-control" id="inputNombre" value="<?php echo $empleado['nombre']; ?>" 
        required>
        <input type="hidden" name="id_Usuario" value="<?php echo htmlspecialchars($empleado['Id_Usuario']); ?>">
        <div class="invalid-feedback">Por favor ingrese Nombre.</div>
      </div>
      <div class="col-md-6">
        <label class="form-label">Apellido: <span style="color: red;">*</span></label>
        <input type="text" name="textApellido" class="form-control" id="inputApellido" value="<?php echo $empleado['apellido']; ?>" required>
        <div class="invalid-feedback">Por favor ingrese Apellido.</div>
      </div>
      <div class="col-md-6">
        <label class="form-label">Cédula:<span style="color: red;">*</span></label>
        <input type="text" name="textCedula" class="form-control" id="numeroEntero_1" oninput="validarNumeroEntero('numeroEntero_1')" value="<?php echo $empleado['cedula']; ?>" required>
        <div class="invalid-feedback">Por favor ingrese el Número de Cédula.</div>
        <p id="mensajeError_1"></p>
      </div>
      <div class="col-md-6">
        <label class="form-label">Fecha de Nacimiento:<span style="color: red;">*</span></label>
        <input type="date" name="textFechaNacimiento" class="form-control" id="inputFechaNacimiento" value="<?php echo $empleado['fechaNacimiento']; ?>" required>
        <div class="invalid-feedback">Por favor ingrese la Fecha de Nacimiento.</div>
      </div>
      <div class="col-md-6">
        <label class="form-label">Celular: <span style="color: red;">*</span></label>
        <input type="text" name="textCelular" class="form-control" id="numeroEntero_2" oninput="validarNumeroEntero('numeroEntero_2')" value="<?php echo $empleado['celular']; ?>" required>
        <div class="invalid-feedback">Por favor ingrese el Número de Celular.</div>
        <p id="mensajeError_2"></p>
      </div>
      <div class="col-md-6">
        <label class="form-label">Dirección: <span style="color: red;">*</span></label>
        <input type="text" name="textDireccion" class="form-control" id="inputDireccion" value="<?php echo $empleado['direccion']; ?>" required>
        <div class="invalid-feedback">Por favor ingrese la Dirección.</div>
      </div>
      <div class="col-md-6">
        <label class="form-label">Correo: <span style="color: red;">*</span></label>
        <input type="email" name="textCorreo" class="form-control" id="inputCorreo" value="<?php echo $empleado['correo']; ?>" required>
        <div class="invalid-feedback">Por favor ingrese el Correo.</div>
      </div>
      <div class="col-md-6">
        <label class="form-label">Estado Civil: <span style="color: red;">*</span></label>
        <input type="text" name="textEstadoCivil" class="form-control" id="inputEstadoCivil" value="<?php echo $empleado['estadoCivil']; ?>" required>
        <div class="invalid-feedback">Por favor ingrese Estado Civil.</div>
      </div>
      <div class="col-md-6">
        <label class="form-label">EPS:</label>
        <input type="text" name="textEps" class="form-control" id="inputEps" value="<?php echo $empleado['eps']; ?>">
      </div>
      <div class="col-md-6">
        <label class="form-label">ARL:</label>
        <input type="text" name="textArl" class="form-control" id="inputArl" value="<?php echo $empleado['arl']; ?>">
      </div>
      <div class="col-md-6">
        <label class="form-label">Fondo de Pensiones:</label>
        <input type="text" name="textFondoPensiones" class="form-control" id="inputFondoPensiones" value="<?php echo $empleado['fondopensiones']; ?>">
      </div>
      <div class="col-md-6">
        <label class="form-label">Fondo de Cesantias:</label>
        <input type="text" name="textFondoCesantias" class="form-control" id="inputFondoCesantias" value="<?php echo $empleado['fondocesantias']; ?>">
      </div>
      <div class="col-md-6">
        <label class="form-label">Entidad Bancaria:</label>
        <input type="text" name="textEntidadBancaria" class="form-control" id="inputEntidadBancaria" value="<?php echo $empleado['entidadBancaria']; ?>">
      </div>
      <div class="col-md-6">
        <label class="form-label">Número de Cuenta:</label>
        <input type="text" name="textNumeroCuenta" class="form-control" id="numeroEntero_3" oninput="validarNumeroEntero('numeroEntero_3')" value="<?php echo $empleado['numeroCuenta']; ?>">
        <p id="mensajeError_3"></p>
      </div>
      <div class="col-md-6">
        <label class="form-label">Fecha Ingreso:<span style="color: red;">*</span></label>
        <input type="date" name="textFechaIngreso" class="form-control" id="inputFechaIngreso" value="<?php echo $empleado['fechaIngreso']; ?>" required>
        <div class="invalid-feedback">Por favor ingrese la Fecha de Ingreso.</div>
      </div>
      <div class="col-md-6">
        <label class="form-label">Fecha terminación de Contrato:</label>
        <input type="date" name="textFechaTerminacion" class="form-control" value="<?php echo $empleado['fechaTerminacion']; ?>">
      </div>
      <div class="col-md-6">
        <label class="form-label">Contacto de Emergencia: <span style="color: red;">*</span></label>
        <input type="text" name="textContacto" class="form-control" id="inputContacto" value="<?php echo $empleado['ContactoEmergencia']; ?>" required>
        <div class="invalid-feedback">Por favor ingrese el Nombre de contacto.</div>
      </div>
      <div class="col-md-6">
        <label class="form-label">Número Contacto de Emergencia:<span style="color: red;">*</span> </label>
        <input type="text" name="textNumeroContacto" class="form-control" id="numeroEntero_4" oninput="validarNumeroEntero('numeroEntero_4')" value="<?php echo $empleado['numeroContactoEmergencia']; ?>" required>
        <div class="invalid-feedback">Por favor ingrese el Número de contacto.</div>
        <p id="mensajeError_4"></p>
      </div>
      <div class="col-12">

        <br>

        <input class="form-control" type="file" name="archivo" id="" >
        <br>
        <button type="submit" class="btn btn-primary" value="Actualizar" name="actualizar" id="actualizar">Actualizar</button>
        <a href="ListaEmpleados.php" type="submit" class="btn btn-danger" value="Cancelar" name="cancelar" id="cancelar">Cancelar</a>
        
        
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


