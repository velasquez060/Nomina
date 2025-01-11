<?php
session_start();

// Verificar si se hizo clic en cerrar sesión
if(isset($_GET['cerrar_sesion'])) {
    session_destroy();
    header("location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/menu.css">    
    <title>Menu</title>
</head>
<body>
<div class="menu-hamburguesa" col-md-2>
    <div class="menu-icono" onclick="toggleMenu()">
        <div class="barra"></div>
        <div class="barra"></div>
        <div class="barra"></div>
    </div>
    <nav class="menu-lateral">
        <ul>
            <li><a href="inicial.php">Inicio</a></li>
            <li><a href="AgregarEmpleado.php">Agregar Empleado</a></li>
            <li><a href="ListaEmpleados.php">Lista Empleados</a></li>
            <li><a href="nominaDiaria.php">Nomina Diaria</a></li>
            <li><a href="AjustesNomina.php">Ajustes Nomina</a></li>
            <li><a href="?cerrar_sesion=1">Cerrar Sesión</a></li>
        </ul>
    </nav>
</div>
<script src="../js/menu.js"></script>
</body>
</html>