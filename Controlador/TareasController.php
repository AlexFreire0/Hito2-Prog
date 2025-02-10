<?php
require_once '../modelo/class_tarea.php';

class EventosController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Evento();
    }

    public function agregarTarea($nombre_evento, $fecha, $lugar) {
        $this->modelo->agregarTarea($nombre_evento, $fecha, $lugar);
    }

    public function listarTareas($idusuario) {
        return $this->modelo->obtenerTareas($idusuario);
    }

    public function obtenerTareaPorId($id_evento) {
        return $this->modelo->obtenerTareaPorId($id_evento);
    }

    public function completarTarea($id_evento, $nombre_evento, $fecha, $lugar) {
        $this->modelo->completarTarea($id_evento, $nombre_evento, $fecha, $lugar);
    }

    public function eliminarTarea($id_evento) {
        $this->modelo->eliminarTarea($id_evento);
    }
}
?>
