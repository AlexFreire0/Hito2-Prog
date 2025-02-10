<?php
class Conexion {
    private $servidor = 'localhost';
    private $usuario = 'root';
    private $password = 'curso';
    private $base_datos = 'Hito_programacion2';
    public $conexion;

    public function __construct() {
        $this->conexion = new mysqli($this->servidor, $this->usuario, $this->password, $this->base_datos);

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public function cerrar() {
        $this->conexion->close();
    }
}
?>
