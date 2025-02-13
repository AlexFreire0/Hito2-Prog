<?php
require_once '../modelo/class_tarea.php';

class TareasController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new Tarea();
    }

    public function agregarTarea($nombre_tarea, $descripcion, $estado, $usuario_id)
    {
        $this->modelo->agregarTarea($nombre_tarea, $descripcion, $estado, $usuario_id);
    }

    public function listarTareas()
    {
        return $this->modelo->obtenerTareas();
    }

    public function listarTareasPorUsuario($usuario_id)
    {
        return $this->modelo->obtenerTareasPorUsuario($usuario_id);
    }

    public function obtenerTareaPorId($id_tarea)
    {
        return $this->modelo->obtenerTareaPorId($id_tarea);
    }

    public function actualizarTarea($id_tarea, $nombre_tarea, $descripcion, $estado)
    {
        $this->modelo->actualizarTarea($id_tarea, $nombre_tarea, $descripcion, $estado);
    }

    public function eliminarTarea($id_tarea)
    {
        $this->modelo->eliminarTarea($id_tarea);
    }
    public function completarTarea($id_tarea)
    {
        $this->modelo->completarTarea($id_tarea);
    }
    public function noCompletarTarea($id_tarea)
    {
        $this->modelo->noCompletarTarea($id_tarea);
    }
}
