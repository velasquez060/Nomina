<?php
class conexion {
    private $host = 'localhost';
    private $dbname = 'nomina';
    private $username = 'root';
    private $password = '12345';
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo ("conexion exitosa");
        } catch (PDOException $e) {
            die("Error al conectar a la base de datos: " . $e->getMessage());
        }
    }
    

    public function prepare($sql) {
        if ($this->pdo) {
            try {
                return $this->pdo->prepare($sql);
            } catch (PDOException $e) {
                throw new Exception("Error al preparar la consulta: " . $e->getMessage());
            }
        } else {
            throw new Exception("No hay conexión a la base de datos.");
        }
    }

    public function ejecutar($sql){//insertar, eliminar, actualizar
        $this->pdo->exec($sql);
        return $this->pdo->lastInsertId();
    }

    public function consultar($sql){
        $sentencia=$this->pdo->prepare($sql);
        $sentencia->execute();
        return $sentencia->fetchAll();
    }

    public function close() {
        $this->pdo = null;
    }
}
?>




