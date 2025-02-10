<?php
require_once '../config/db_config.php';

class Usuario {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function agregarUsuario($nombre, $apellido, $correo_electronico, $fecha_nacimiento, $plan_base, $duracion_suscripcion, $paquetes_adicionales) {
        // Convertir la fecha de nacimiento a formato adecuado para SQL (YYYY-MM-DD)
        if ($fecha_nacimiento instanceof DateTime) {
            $fecha_nacimiento = $fecha_nacimiento->format('Y-m-d');
        }
    
        // Insertar usuario
        $query = "INSERT INTO Usuarios (nombre, apellidos, correo_electronico, fecha_nacimiento, plan_base, duracion_suscripcion) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("ssssss", $nombre, $apellido, $correo_electronico, $fecha_nacimiento, $plan_base, $duracion_suscripcion);
    
        if ($stmt->execute()) {
            $usuario_id = $stmt->insert_id; // Obtener el ID del usuario insertado
    
            // Comprobación para ver el ID
            echo "ID del usuario insertado: " . $usuario_id . "<br>";
    
            // Verificar si el usuario_id es válido
            if ($usuario_id > 0) {
                echo "Usuario agregado con éxito. ID de usuario: " . $usuario_id . "<br>";
                foreach ($paquetes_adicionales as $paquete) {
                echo "$paquete";
                }
                // Solo asignar paquetes si el usuario fue insertado correctamente
                if (!empty($paquetes_adicionales)) {
                    $this->asignarPaquetes($usuario_id, $paquetes_adicionales);
                }  else {
                    echo "no va";
                }
            } else {
                echo "Error: No se pudo obtener un ID válido para el usuario.<br>";
            }
        } else {
            echo "Error al agregar el usuario: " . $stmt->error . "<br>";
        }
    
        $stmt->close();
    }
    
    public function asignarPaquetes($usuario_id, $paquetes_adicionales) {
        echo "asignarPaquetes llamado<br>";  // Verifica si la función se llama
        if (empty($usuario_id)) {
            echo "Error: El ID del usuario es inválido o no fue proporcionado.<br>";
            return;
        }
    
        // Insertar paquetes en la tabla Usuarios_Paquetes
        $query = "INSERT INTO Usuarios_Paquetes (usuario_id, paquete_id) VALUES (?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
    
        foreach ($paquetes_adicionales as $paquete_id) {
            echo "Asignando paquete con ID: $paquete_id<br>";  // Verifica el paquete que se está asignando
            $stmt->bind_param("ii", $usuario_id, $paquete_id);
            if (!$stmt->execute()) {
                echo "Error al asignar el paquete: " . $stmt->error . "<br>";
            }
        }
    
        $stmt->close();
    }
    
    
    public function obtenerUsuarios() {
        $query = "SELECT * FROM Usuarios";
        $resultado = $this->conexion->conexion->query($query);
        $usuarios = [];
        while ($fila = $resultado->fetch_assoc()) {
            $usuarios[] = $fila;
        }
        return $usuarios;
    }

    public function obtenerUsuarioPorId($id_usuario) {
        $query = "SELECT * FROM Usuarios WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    public function actualizarUsuario($id_usuario, $nombre, $apellido, $correo_electronico, $fecha_nacimiento, $plan_base, $duracion_suscripcion, $paquetes_adicionales = []) {
        // Convertir la fecha de nacimiento a formato adecuado para SQL (YYYY-MM-DD)
        if ($fecha_nacimiento instanceof DateTime) {
            $fecha_nacimiento = $fecha_nacimiento->format('Y-m-d');
        }

        // Actualizar usuario
        $query = "UPDATE Usuarios SET nombre = ?, apellidos = ?, correo_electronico = ?, fecha_nacimiento = ?, plan_base = ?, duracion_suscripcion = ? WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("ssssssi", $nombre, $apellido, $correo_electronico, $fecha_nacimiento, $plan_base, $duracion_suscripcion, $id_usuario);

        if ($stmt->execute()) {
            // Actualizar paquetes
            $this->eliminarPaquetes($id_usuario);
            if (!empty($paquetes_adicionales)) {
                $this->asignarPaquetes($id_usuario, $paquetes_adicionales);
            }

            echo "Usuario actualizado con éxito.";
        } else {
            echo "Error al actualizar usuario: " . $stmt->error;
        }

        $stmt->close();
    }

    public function eliminarPaquetes($usuario_id) {
        // Eliminar paquetes asociados al usuario
        $query = "DELETE FROM Usuarios_Paquetes WHERE usuario_id = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $stmt->close();
    }

    public function eliminarUsuario($id_usuario) {
        // Eliminar paquetes relacionados antes de eliminar el usuario
        $this->eliminarPaquetes($id_usuario);

        // Eliminar usuario
        $query = "DELETE FROM Usuarios WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_usuario);

        if ($stmt->execute()) {
            echo "Usuario eliminado con éxito.";
        } else {
            echo "Error al eliminar usuario: " . $stmt->error;
        }

        $stmt->close();
    }


    public function agregarPaqueteAUsuario($id_usuario, $paquete) {
        $query = "INSERT INTO Usuarios_Paquetes (usuario_id, paquete_id) VALUES (?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("ii", $id_usuario, $paquete);
        echo "Iduser: $id_usuario";
        if ($stmt->execute()) {
            echo "Paquete agregado al usuario con éxito.";
        } else {
            echo "Error al agregar el paquete al usuario: " . $stmt->error;
        }

        $stmt->close();
    }
    public function obtenerPacksUsuario($id_usuario) {
        $query = "SELECT paquete_id FROM Usuarios_Paquetes WHERE usuario_id = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}
?>
