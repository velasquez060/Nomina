<?php
  $server= "localhost";
  $database= "nomina";
  $user = "root";
  $password = "12345";

  try{
    $conexion = new PDO("mysql:host=$server;dbname=$database;",$user,$password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conexión exitosa a la base de datos";

  }catch(PDOException $e){
    echo "Error al hacer la conexion con la base de datos" . $e->getMessage();
  }


?>