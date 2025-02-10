<?php
require_once '../config/db_config.php';

class Tarea {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function agregarTarea($nombre_tarea, $fecha, $descripcion) {
        $query = "INSERT INTO tareas (nombre_tarea, fecha, descripcion) VALUES (?, ?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("sss", $nombre_tarea, $fecha, $descripcion);

        if ($stmt->execute()) {
            echo "Tarea agregada con éxito.";
        } else {
            echo "Error al agregar la tarea: " . $stmt->error;
        }

        $stmt->close();
    }

    public function obtenerTareas() {
        $query = "SELECT * FROM tareas";
        $resultado = $this->conexion->conexion->query($query);
        $tareas = [];
        while ($fila = $resultado->fetch_assoc()) {
            $tareas[] = $fila;
        }
        return $tareas;
    }

    public function obtenerTareaPorId($id_tarea) {
        $query = "SELECT * FROM tareas WHERE id_tarea = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_tarea);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    public function actualizarTarea($id_tarea, $nombre_tarea, $fecha, $descripcion) {
        $query = "UPDATE tareas SET nombre_tarea = ?, fecha = ?, descripcion = ? WHERE id_tarea = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("sssi", $nombre_tarea, $fecha, $descripcion, $id_tarea);

        if ($stmt->execute()) {
            echo "Tarea actualizada con éxito.";
        } else {
            echo "Error al actualizar la tarea: " . $stmt->error;
        }

        $stmt->close();
    }

    public function eliminarTarea($id_tarea) {
        $query = "DELETE FROM tareas WHERE id_tarea = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_tarea);

        if ($stmt->execute()) {
            echo "Tarea eliminada con éxito.";
        } else {
            echo "Error al eliminar la tarea: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>
