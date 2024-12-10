<?php
class Conexion {
    private $conexion;
    
    public function __construct() {
        $Host = 'localhost';
        $Usuario = 'root';
        $Contrasena = 'redhoodie007';
        $Puerto = 3306;
        $DBnombre = 'db_bdm_cursos'; // Nombre de la base de datos
        
        try {
            // Establecer la conexión con PDO al servidor MySQL
            $this->conexion = new PDO("mysql:host=$Host;port=$Puerto", $Usuario, $Contrasena);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Usar la base de datos
            $this->conexion->exec("USE $DBnombre");

           
            

        } catch (PDOException $exp) {

            die($exp->getMessage());
        }
    }
    
    public function obtenerConexion() {
        return $this->conexion;
    }
}

// Prueba de la conexión y mostrar tablas
$conexion = new Conexion();
?>
