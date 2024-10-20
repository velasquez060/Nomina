<?php
include("../Menu.php");
require('../conexion/conexion.php');
$objconexion = new conexion();


$sql2 = "select * from configuracion";
$stmt_verificar = $objconexion->prepare($sql2);
$stmt_verificar->execute();
$Consultatabla = $stmt_verificar->rowCount();



if ($Consultatabla >= 1) {
  $salariobasico = "";
  $valorhora = "";
  $valorHoraExtraDiurna = "";
  $valorHoraExtraNocturna = "";
  $valorHoraExtraDominical = "";
  $valorHoraExtraDominicalNocturna = "";
  $valorHoraDomingosFestivos = "";
  $valorRecargoNocturno = "";
  $valorAuxilioTransporte = "";
  $valorSalud = "";
  $valorPension = "";
  $ajustePorcentual = "";
  $row_verificar = $stmt_verificar->fetch(PDO::FETCH_ASSOC);


  $id_configuracion = isset($row_verificar['id_configuracion']) ? $row_verificar['id_configuracion'] : "";
  $salariobasico = isset($row_verificar['salario_basico']) ? $row_verificar['salario_basico'] : "";
  $salariobasicoformateado = number_format($salariobasico, 0, '', '.');
  $valor_hora = isset($row_verificar['valor_hora']) ? $row_verificar['valor_hora'] : "";
  $valor_horaformateado = number_format($valor_hora, 0, '', '.');
  $valor_hora_extra_diurna = isset($row_verificar['valor_hora_extra_diurna']) ? $row_verificar['valor_hora_extra_diurna'] : "";
  $valor_hora_extra_diurnaformateado = number_format($valor_hora_extra_diurna, 0, '', '.');
  $valor_hora_extra_nocturna = isset($row_verificar['valor_hora_extra_nocturna']) ? $row_verificar['valor_hora_extra_nocturna'] : "";
  $valor_hora_extra_nocturnaformateado = number_format($valor_hora_extra_nocturna, 0, '', '.');
  $valor_hora_extra_dominical = isset($row_verificar['valor_hora_extra_dominical']) ? $row_verificar['valor_hora_extra_dominical'] : "";
  $valor_hora_extra_dominicalformateado = number_format($valor_hora_extra_dominical, 0, '', '.');
  $valor_hora_extra_dominical_nocturna = isset($row_verificar['valor_hora_extra_dominical_nocturna']) ? $row_verificar['valor_hora_extra_dominical_nocturna'] : "";
  $valor_hora_extra_dominical_nocturnaformateado = number_format($valor_hora_extra_dominical_nocturna, 0, '', '.');
  $valor_hora_domingos_festivos = isset($row_verificar['valor_hora_domingos_festivos']) ? $row_verificar['valor_hora_domingos_festivos'] : "";
  $valor_hora_domingos_festivosformateado = number_format($valor_hora_domingos_festivos, 0, '', '.');
  $valor_recargo_nocturno = isset($row_verificar['valor_recargo_nocturno']) ? $row_verificar['valor_recargo_nocturno'] : "";
  $valor_recargo_nocturnoformateado = number_format($valor_recargo_nocturno, 0, '', '.');
  $valor_auxilio_transporte = isset($row_verificar['valor_auxilio_transporte']) ? $row_verificar['valor_auxilio_transporte'] : "";
  $valor_auxilio_transporteformateado = number_format($valor_auxilio_transporte, 0, '', '.');
  $valor_salud = isset($row_verificar['valor_salud']) ? $row_verificar['valor_salud'] : "";
  $valor_saludformateado = number_format($valor_salud, 0, '', '.');
  $valor_pension = isset($row_verificar['valor_pension']) ? $row_verificar['valor_pension'] : "";
  $valor_pensionformateado = number_format($valor_pension, 0, '', '.');
  $ajuste_porcentual = isset($row_verificar['ajuste_porcentual']) ? $row_verificar['ajuste_porcentual'] : "";
} else {
  // funcionalidad de guardar 
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardar'])) {
    $salariobasico = htmlspecialchars($_POST["salarioBasico"]);
    $reajusteValorHora = $valorHora = $_POST['valorHora'] = $salariobasico / 230;
    $reajusteValorHoraExtraDiurna = $valorHoraExtraDiurna = $_POST['valorHoraExtraDiurna'] = $reajusteValorHora * 1.25;
    $reajusteValorHoraExtraNocturna = $valorHoraExtraNocturna = $_POST['valorHoraExtraNocturna'] = $reajusteValorHora * 1.75;
    $reajusteValorHoraExtraDominical = $valorHoraExtraDominical = $_POST['valorHoraExtraDominical'] =  $reajusteValorHora * 2;
    $reajusteValorHoraExtraDominicalNocturna = $valorHoraExtraDominicalNocturna = $_POST['valorHoraExtraDominicalNocturna'] = $reajusteValorHora  * 2.5;
    $reajusteValorHoraDomingosFestivos = $valorHoraDomingosFestivos = $_POST['valorHoraDomingosFestivos'] = $reajusteValorHora * 1.75;
    $reajusteValorRecargoNocturno = $valorRecargoNocturno = $_POST['valorRecargoNocturno'] = $reajusteValorHora * 0.35;
    $valorAuxilioTransporte = htmlspecialchars($_POST["valorAuxilioTransporte"]);
    $reajustevalorSalud = $valorSalud = $_POST['valorSalud'] = $salariobasico * 0.04;
    $reajustevalorPension = $valorPension = $_POST['valorPension'] = $salariobasico * 0.04;





    if (!empty($salariobasico) && !empty($valorAuxilioTransporte)) {

      try {
        $sql = "INSERT INTO configuracion (salario_basico, valor_hora, valor_hora_extra_diurna, valor_hora_extra_nocturna, valor_hora_extra_dominical, valor_hora_extra_dominical_nocturna, valor_hora_domingos_festivos, valor_recargo_nocturno, valor_auxilio_transporte, valor_salud, valor_pension) VALUES ('$salariobasico', '$reajusteValorHora', '$reajusteValorHoraExtraDiurna','$reajusteValorHoraExtraNocturna', '$reajusteValorHoraExtraDominical', '$reajusteValorHoraExtraDominicalNocturna', '$reajusteValorHoraDomingosFestivos', '$reajusteValorRecargoNocturno', '$valorAuxilioTransporte', '$reajustevalorSalud', '$reajustevalorPension')";

        $stmt = $objconexion->prepare($sql);


        if ($stmt->execute()) {
          echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
          echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Éxito',
                        text: '¡Actualización Agregada Correctamente!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'AjustesNomina.php';}
                    });
                });
            </script>";
        } else {
          echo "Error al agregar Configuración.";
        }
      } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
    } else {

      echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
      echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al agregar la configuración.',
                    icon: 'error',
                    confirmButtonText: 'Intentar de nuevo'
                }).then((result) => {
                    if (result.isConfirmed) 
                        window.location.href = 'AjustesNomina.php';
                        exit();
                    }
                });
            });
        </script>";
    }
  } else {
    //echo "No se recibieron datos del formulario.";
  }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['actualizar'])) {

  $id_configuracion = $_POST['id_configuracion'];
  $ajustePorcentual = $_POST['ajustePorcentual'];
  $ajustePorcentual = isset($_POST['ajustePorcentual']) ? $_POST['ajustePorcentual'] : '';
  if (empty($ajustePorcentual) || !is_numeric($ajustePorcentual)) {
    echo "<script>alert('el campo ajuste procentual esta vacio, Agregue un valor');</script>";
    echo "<script> window.location.href = 'AjustesNomina.php';</script>"; //pendiente solucionar alerta   
  }
  $reajusteSalarioBasico = $salariobasico = $_POST['salarioBasico'] = $salariobasico + ($salariobasico *  $ajustePorcentual);
  $salariobasicoprueba = str_replace('.', '.', $reajusteSalarioBasico);
  $reajusteValorHora = $valorHora = $_POST['valorHora'] = $salariobasico / 230;
  $valorhoraprueba = str_replace('.', '.', $reajusteValorHora);
  $reajusteValorHoraExtraDiurna = $valorHoraExtraDiurna = $_POST['valorHoraExtraDiurna'] = $reajusteValorHora * 1.25;
  $valorHoraExtraDiurnaprueba = str_replace('.', '.', $reajusteValorHoraExtraDiurna);
  $reajusteValorHoraExtraNocturna = $valorHoraExtraNocturna = $_POST['valorHoraExtraNocturna'] = $reajusteValorHora * 1.75;
  $valorHoraExtraNocturnaprueba = str_replace('.', '.', $reajusteValorHoraExtraNocturna);
  $reajusteValorHoraExtraDominical = $valorHoraExtraDominical = $_POST['valorHoraExtraDominical'] =  $reajusteValorHora * 2;
  $valorHoraExtraDominicalprueba = str_replace('.', '.', $reajusteValorHoraExtraDominical);
  $reajusteValorHoraExtraDominicalNocturna = $valorHoraExtraDominicalNocturna = $_POST['valorHoraExtraDominicalNocturna'] = $reajusteValorHora  * 2.5;
  $valorHoraExtraDominicalNocturnaprueba = str_replace('.', '.', $reajusteValorHoraExtraDominicalNocturna);
  $reajusteValorHoraDomingosFestivos = $valorHoraDomingosFestivos = $_POST['valorHoraDomingosFestivos'] = $reajusteValorHora * 1.75;
  $valorHoraDomingosFestivosprueba = str_replace('.', '.', $reajusteValorHoraDomingosFestivos);
  $reajusteValorRecargoNocturno = $valorRecargoNocturno = $_POST['valorRecargoNocturno'] = $reajusteValorHora * 0.35;
  $valorRecargoNocturnoprueba = str_replace('.', '.', $reajusteValorRecargoNocturno);
  $reajustevalorSalud = $valorSalud = $_POST['valorSalud'] = $salariobasico * 0.04;
  $valorSaludprueba = str_replace('.', '.', $reajustevalorSalud);
  $reajustevalorPension = $valorPension = $_POST['valorPension'] = $salariobasico * 0.04;
  $valorPensionprueba = str_replace('.', '.', $reajustevalorPension);

  $sqlreajuste = "UPDATE configuracion 
                  SET salario_basico = '$salariobasicoprueba', 
                  valor_hora = '$valorhoraprueba',
                  valor_hora_extra_diurna = '$valorHoraExtraDiurnaprueba', 
                  valor_hora_extra_nocturna = '$valorHoraExtraNocturnaprueba',
                  valor_hora_extra_dominical = '$valorHoraExtraDominicalprueba', 
                  valor_hora_extra_dominical_nocturna = '$valorHoraExtraDominicalNocturnaprueba',
                  valor_hora_domingos_festivos = '$valorHoraDomingosFestivosprueba',
                  valor_recargo_nocturno = '$valorRecargoNocturnoprueba', 
                  ajuste_porcentual = '$ajustePorcentual',
                  valor_salud =  '$valorSaludprueba',
                  valor_pension = '$valorPensionprueba'

                WHERE id_configuracion = $id_configuracion;";


  $stmt_verificar = $objconexion->prepare($sqlreajuste);

  $stmt_verificar->execute();

  $validacionreAjuste = $stmt_verificar->rowCount();

  if ($validacionreAjuste >= 1) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
          document.addEventListener('DOMContentLoaded', function() {
              Swal.fire({
                  title: 'Éxito',
                  text: '¡Actualización Agregada Correctamente!',
                  icon: 'success',
                  confirmButtonText: 'OK'
              }).then((result) => {
                  if (result.isConfirmed) {
                      window.location.href = 'AjustesNomina.php';}
              });
          });
      </script>";
  };
} else {
  echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
  echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Error',
                text: 'Hubo un problema al agregar la configuración.',
                icon: 'error',
                confirmButtonText: 'Intentar de nuevo'
            }).then((result) => {
                if (result.isConfirmed) 
                    window.location.href = 'AjustesNomina.php';
                    exit();
                }
            });
        });
    </script>";
}


if ($_SERVER['REQUEST_METHOD'] ==  'POST' && isset($_POST['eliminar'])) {
  $id_configuracion = $_POST['id_configuracion'];
  $sqleliminar = "DELETE FROM configuracion WHERE id_configuracion = :id";
  $stmt_eliminar = $objconexion->prepare($sqleliminar);
  $stmt_eliminar->bindParam(':id', $id_configuracion, PDO::PARAM_INT);
  $stmt_eliminar->execute();
  $validacion = $stmt_eliminar->rowCount();

  if ($validacion >= 1) {


    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
          document.addEventListener('DOMContentLoaded', function() {
              Swal.fire({
                  title: 'Éxito',
                  text: '¡El registro se borro exitosamente!',
                  icon: 'success',
                  confirmButtonText: 'OK'
              }).then((result) => {
                  if (result.isConfirmed) {
                      window.location.href = 'AjustesNomina.php';}
              });
          });
      </script>";
  } else {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Error',
                text: 'Hubo un problema al eliminar el registro.',
                icon: 'error',
                confirmButtonText: 'Intentar de nuevo'
            }).then((result) => {
                if (result.isConfirmed) 
                    window.location.href = 'AjustesNomina.php';
                    exit();
                }
            });
        });
    </script>";
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
    content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous" />


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
          <input type="text" name="salarioBasico" class="form-control" value="<?php echo ($salariobasicoformateado = isset($row_verificar['salario_basico']) ? $salariobasicoformateado : "");  ?>" id="numeroEntero_1" oninput="validarNumeroEntero('numeroEntero_1')">
          <p id="mensajeError_1"></p>
          <input type="hidden" name="id_configuracion" value="<?php echo $id_configuracion = isset($row_verificar['id_configuracion']) ? $row_verificar['id_configuracion'] : ""; ?>">
        </div>
        <div class="col-md-6">
          <label for="valorHora" class="form-label">Valor Hora:</label>
          <input type="text" name="valorHora" class="form-control" value="<?php echo htmlspecialchars($valor_horaformateado = isset($row_verificar['valor_hora']) ? $valor_horaformateado : ""); ?>" id="numeroEntero_2" oninput="validarNumeroEntero('numeroEntero_2')">
          <p id="mensajeError_2"></p>
        </div>
      </div>
      <div class="row mb-1">
        <div class="col-md-6 mb-3 mb-md-0">
          <label for="valorHoraExtraDiurna" class="form-label">Valor Hora Extra Diurna:</label>
          <input type="text" name="valorHoraExtraDiurna" class="form-control" value="<?php echo htmlspecialchars($valor_hora_extra_diurnaformateado = isset($row_verificar['valor_hora_extra_diurna']) ? $valor_hora_extra_diurnaformateado : ""); ?>" id="numeroEntero_3" oninput="validarNumeroEntero('numeroEntero_3')">
          <p id="mensajeError_3"></p>
        </div>
        <div class="col-md-6">
          <label for="valorHoraExtraNocturna" class="form-label">Valor Hora Extra Nocturna:</label>
          <input type="text" name="valorHoraExtraNocturna" class="form-control" value="<?php echo htmlspecialchars($valor_hora_extra_nocturnaformateado = isset($row_verificar['valor_hora_extra_nocturna']) ? $valor_hora_extra_nocturnaformateado : ""); ?>" id="numeroEntero_4" oninput="validarNumeroEntero('numeroEntero_4')">
          <p id="mensajeError_4"></p>
        </div>
      </div>
      <div class="row mb-1">
        <div class="col-md-6 mb-3 mb-md-0">
          <label for="valorHoraExtraDominical" class="form-label">Valor Hora Extra Dominical:</label>
          <input type="text" name="valorHoraExtraDominical" class="form-control" value="<?php echo htmlspecialchars($valor_hora_extra_dominicalformateado = isset($row_verificar['valor_hora_extra_dominical']) ? $valor_hora_extra_dominicalformateado : ""); ?>" id="numeroEntero_5" oninput="validarNumeroEntero('numeroEntero_5')">
          <p id="mensajeError_5"></p>
        </div>
        <div class="col-md-6">
          <label for="valorHoraExtraDominicalNocturna" class="form-label">Valor Hora Extra Dominical Nocturna:</label>
          <input type="text" name="valorHoraExtraDominicalNocturna" class="form-control" value="<?php echo htmlspecialchars($valor_hora_extra_dominical_nocturnaformateado = isset($row_verificar['valor_hora_extra_dominical_nocturna']) ? $valor_hora_extra_dominical_nocturnaformateado : ""); ?>" id="numeroEntero_6" oninput="validarNumeroEntero('numeroEntero_6')">
          <p id="mensajeError_6"></p>
        </div>
      </div>
      <div class="row mb-1">
        <div class="col-md-6 mb-3 mb-md-0">
          <label for="valorHoraDomingosFestivos" class="form-label">Valor Hora Domingos y Festivos:</label>
          <input type="text" name="valorHoraDomingosFestivos" class="form-control" value="<?php echo htmlspecialchars($valor_hora_domingos_festivosformateado = isset($row_verificar['valor_hora_domingos_festivos']) ? $valor_hora_domingos_festivosformateado : ""); ?>" id="numeroEntero_7" oninput="validarNumeroEntero('numeroEntero_7')">
          <p id="mensajeError_7"></p>
        </div>
        <div class="col-md-6">
          <label for="valorRecargoNocturno" class="form-label">Valor Recargo Nocturno:</label>
          <input type="text" name="valorRecargoNocturno" class="form-control" value="<?php echo htmlspecialchars($valor_recargo_nocturnoformateado = isset($row_verificar['valor_recargo_nocturno']) ? $valor_recargo_nocturnoformateado : ""); ?>" id="numeroEntero_8" oninput="validarNumeroEntero('numeroEntero_8')">
          <p id="mensajeError_8"></p>
        </div>
      </div>
      <div class="row mb-1">
        <div class="col-md-6 mb-3 mb-md-0">
          <label for="valorAuxilioTransporte" class="form-label">Valor Auxilio de transporte:</label>
          <input type="text" name="valorAuxilioTransporte" class="form-control" value="<?php echo htmlspecialchars($valor_auxilio_transporteformateado = isset($row_verificar['valor_auxilio_transporte']) ? $valor_auxilio_transporteformateado : ""); ?>" id="numeroEntero_9" oninput="validarNumeroEntero('numeroEntero_9')">
          <p id="mensajeError_9"></p>
        </div>
        <div class="col-md-6">
          <label for="valorSalud" class="form-label">Valor Salud:</label>
          <input type="text" name="valorSalud" class="form-control" value="<?php echo htmlspecialchars($valor_saludformateado = isset($row_verificar['valor_salud']) ? $valor_saludformateado : ""); ?>" id="numeroEntero_10" oninput="validarNumeroEntero('numeroEntero_10')">
          <p id="mensajeError_10"></p>
        </div>
      </div>
      <div class="row mb-1">
        <div class="col-md-6 mb-3 mb-md-0">
          <label for="valorPension" class="form-label">Valor Pensión:</label>
          <input type="text" name="valorPension" class="form-control" value="<?php echo htmlspecialchars($valor_pensionformateado = isset($row_verificar['valor_pension']) ? $valor_pensionformateado : ""); ?>" id="numeroEntero_11" oninput="validarNumeroEntero('numeroEntero_11')">
          <p id="mensajeError_11"></p>
        </div>
        <div class="col-md-6 mb-3 mb-md-0">
          <label for="salarioBasico" class="form-label">Ajuste porcentual:</label>
          <input type="text" name="ajustePorcentual" class="form-control" value="<?php echo htmlspecialchars($ajuste_porcentual = isset($row_verificar['ajuste_porcentual']) ? $row_verificar['ajuste_porcentual'] : ""); ?>">
        </div>
      </div>
      <div class="row">
        <div class="col-12 text-start">
          <button type="submit" class="btn btn-primary me-2" name="actualizar">Actualizar</button>
          <button type="submit" class="btn btn-primary me-2" name="guardar">Guardar</button>
          <!-- <a  class="btn btn-danger" title="Eliminar" name="eliminar" href="" role="button">Eliminar</a> -->
          <button type="submit" class="btn btn-danger" name="eliminar" title="Eliminar">Eliminar</button>
          <a href="../Empleado/ListaEmpleados.php" class="btn btn-danger cancel">Cancelar</a>
        </div>
      </div>
  </div>
  </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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