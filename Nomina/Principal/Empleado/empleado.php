<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-escalable=no, initial-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../../Css/empleado.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    
    <title>Ficha empleado</title>
</head>
<body>
    <header class="showcase">
        <div class="showcase-top">
            <img src="img/logo.png" alt="">
        </div>                   
    </header> 
    <nav>
        <ul>
            <li><a href="Ficha_empleado.html"><h1>Opciones</h1>
                <img src="./img/flecha-curva-hacia-abajo.png"><br/></a>
                <ul>
                    <li><a href="#">Inicio</a></li>
                    <li><a href="html/index.html">Cerrar sesion</a></li>
                    
                </ul>
            </li>
        </ul>
    </nav> 
    
    <div id="formulario">
        <form name="ficha de empleado">
            <table class="formulario">
                <tr>
                    <td class="titulo" colspan="3">FICHA DE EMPLEADO</td>
                </tr>
        <div class= "row g-3">
            <div class="col-sm-7">
                <tr>
                    <td class="letras">Nombres:</td>
                    <td colspan="2">
                        <input type="text" name="textNombres" class="valor" size="46">
                    </td>
                </tr>
            </div>
        </div>
                <tr>
                    <td class="letras">Apellidos:</td>
                    <td colspan="2">
                        <input type="text" class="valor"name="textApellidos" size="46">
                    </td>
                </tr>
                <tr>
                    <td class="letras">Fecha de nacimiento:</td>
                    <td colspan="2">
                        <input type="date" name="dateFecha" class="valor">
                    </td>
                </tr>
                <tr>
                    <td class="letras">Cedula:</td>
                    <td colspan="2">
                        <input type="text" name="textCedula" maxlength="15" placeholder="Sin puntos ni guiones" class="valor">
                    </td>
                </tr>
                <tr>
                    <td class="letras">Celular:</td>
                    <td colspan="2">
                        <input type="text" name="textCelular" maxlength="10" placeholder="Sin puntos ni guiones" class="valor">
                    </td>
                </tr>
                <tr>
                    <td class="letras">Telefono:</td>
                    <td colspan="2">
                        <input type="text" name="textTelefono"maxlength="10" class="valor" placeholder="Sin puntos ni guiones">
                    </td>
                </tr>
                <tr>
                    <td class="letras">Dirección:</td>
                    <td colspan="2">
                        <input type="text" class="valor" name="textDireccion" size="46">
                    </td>
                </tr>
                <tr>
                    <td class="letras">Correo:</td>
                    <td colspan="2">
                        <input type="email" class="valor" name="textCorreo" size="46">
                    </td>
                </tr>
                <tr>
                    <td class="letras">Estado civil:</td>
                    <td colspan="2">
                        <input type="text" class="valor" name="textEstado">
                    </td>
                </tr>
                <tr>
                    <td class="letras">Genero:</td>
                    <td colspan="2">
                        <input type="radio" class="valor" name="opSexo" value="m">Masculino
                        <input type="radio" class="valor" name="opSexo" value="f">Femenino
                    </td>
                </tr>
                <tr>
                    <td class="letras">EPS:</td>
                    <td colspan="2">
                        <input type="text" class="valor" name="textEps">
                    </td>
                </tr>
                <tr>
                    <td class="letras">Cargo:</td>
                    <td colspan="2">
                        <input type="text" class="valor" name="textCargo">
                    </td>
                </tr>
                <tr>
                    <td class="letras">Fondo de Pensiones:</td>
                    <td colspan="2">
                        <input type="user" class="valor" name="textUsuario">
                    </td>
                </tr>
                <tr>
                    <td class="letras">Fecha de Ingreso:</td>
                    <td colspan="2">
                        <input type="date" name="dateFecha" class="valor">
                    </td>
                </tr>
                <tr>
                    <td class="letras">Fecha de Terminación de Contrato:</td>
                    <td colspan="2">
                        <input type="date" name="dateFecha" class="valor">
                    </td>
                </tr>
                <tr>
                    <td class="titulo" colspan="3">
                        <input type="submit" name="btnAgregar" class="letras" value="Agregar nuevo registro">
                        <input type="submit" name="btnGuardar" class="letras" value="Adjuntar Archivo">
                        <input type="submit" name="btnEliminar" class="letras" value="Eliminar registro">
                    </td>
                </tr>

            </table>
        </form>
    </div>
    
</body>
</html>       

