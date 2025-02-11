<?php
require_once '../modelo/class_tarea.php';

class TareasController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Tarea();
    }

    public function agregarTarea($nombre_tarea, $fecha, $descripcion) {
        $this->modelo->agregarTarea($nombre_tarea, $fecha, $descripcion);
    }

    public function listarTareas() {
        return $this->modelo->obtenerTareas();
    }

    public function obtenerTareaPorId($id_tarea) {
        return $this->modelo->obtenerTareaPorId($id_tarea);
    }

    public function actualizarTarea($id_tarea, $nombre_tarea, $fecha, $descripcion) {
        $this->modelo->actualizarTarea($id_tarea, $nombre_tarea, $fecha, $descripcion);
    }

    public function eliminarTarea($id_tarea) {
        $this->modelo->eliminarTarea($id_tarea);
    }
}
?>
