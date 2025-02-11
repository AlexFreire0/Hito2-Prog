<?php
require_once '../config/db_config.php';

class Tarea {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function agregarTarea($nombre_tarea, $descripcion, $estado, $usuario_id) {
        $query = "INSERT INTO tareas (nombre, descripcion, Estado) VALUES (?, ?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("sss", $nombre_tarea, $descripcion, $estado);

        if ($stmt->execute()) {
            $tarea_id = $stmt->insert_id;
            $this->asignarTareaAUsuario($usuario_id, $tarea_id);
            echo "Tarea agregada con éxito.";
        } else {
            echo "Error al agregar la tarea: " . $stmt->error;
        }

        $stmt->close();
    }

    public function asignarTareaAUsuario($usuario_id, $tarea_id) {
        $query = "INSERT INTO Usuarios_Tareas (usuario_id, tarea_id) VALUES (?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("ii", $usuario_id, $tarea_id);

        if ($stmt->execute()) {
            echo "Tarea asignada al usuario con éxito.";
        } else {
            echo "Error al asignar la tarea al usuario: " . $stmt->error;
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

    public function obtenerTareasPorUsuario($usuario_id) {
        $query = "SELECT t.* FROM tareas t
                  JOIN Usuarios_Tareas ut ON t.id = ut.tarea_id
                  WHERE ut.usuario_id = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
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

    public function actualizarTarea($id_tarea, $nombre_tarea, $descripcion, $estado) {
        $query = "UPDATE tareas SET nombre = ?, descripcion = ?, Estado = ? WHERE id_tarea = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("sssi", $nombre_tarea, $descripcion, $estado, $id_tarea);

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
