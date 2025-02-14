<?php
class Conexion {
    // Servidor de base de datos y sus datos
    private $servidor = 'localhost';
    private $usuario = 'root';
    private $password = 'curso';
    private $base_datos = 'Hito_programacion2';
    public $conexion;

    // Constructor para inicializar la conexión
    public function __construct() {
        $this->conexion = new mysqli($this->servidor, $this->usuario, $this->password, $this->base_datos);

        // Verificar si hay error de conexión
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    // Método para cerrar la conexión
    public function cerrar() {
        $this->conexion->close();
    }
}
?>
