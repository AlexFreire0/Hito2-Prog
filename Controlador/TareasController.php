<?php
require_once '../modelo/class_tarea.php';

class TareasController
{
    private $modelo;

    // Constructor
    public function __construct()
    {
        $this->modelo = new Tarea();
    }

    // Agregar una nueva tarea
    public function agregarTarea($nombre_tarea, $descripcion, $estado, $usuario_id)
    {
        $this->modelo->agregarTarea($nombre_tarea, $descripcion, $estado, $usuario_id);
    }

    // Listar todas las tareas
    public function listarTareas()
    {
        return $this->modelo->obtenerTareas();
    }

    // Listar tareas por usuario
    public function listarTareasPorUsuario($usuario_id)
    {
        return $this->modelo->obtenerTareasPorUsuario($usuario_id);
    }

    // Obtener tarea por ID
    public function obtenerTareaPorId($id_tarea)
    {
        return $this->modelo->obtenerTareaPorId($id_tarea);
    }

    // Actualizar una tarea
    public function actualizarTarea($id_tarea, $nombre_tarea, $descripcion, $estado)
    {
        $this->modelo->actualizarTarea($id_tarea, $nombre_tarea, $descripcion, $estado);
    }

    // Eliminar una tarea
    public function eliminarTarea($id_tarea)
    {
        $this->modelo->eliminarTarea($id_tarea);
    }

    // Marcar una tarea como completada
    public function completarTarea($id_tarea)
    {
        $this->modelo->completarTarea($id_tarea);
    }

    // Marcar una tarea como no completada
    public function noCompletarTarea($id_tarea)
    {
        $this->modelo->noCompletarTarea($id_tarea);
    }
}
