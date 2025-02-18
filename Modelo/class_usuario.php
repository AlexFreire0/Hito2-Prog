<?php
require_once '../config/db_config.php';

class Usuario {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    // Agregar un nuevo usuario
    public function agregarUsuario($nombreuser, $correo_electronico, $password) {
        $query = "INSERT INTO Usuarios (nombreuser, correo_electronico, password) VALUES (?, ?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("sss", $nombreuser, $correo_electronico, $password);

        if ($stmt->execute()) {
            // Usuario agregado con éxito
        } else {
            echo "Error al agregar el usuario: " . $stmt->error;
        }

        $stmt->close();
    }

    // Obtener todos los usuarios
    public function obtenerUsuarios() {
        $query = "SELECT * FROM Usuarios";
        $resultado = $this->conexion->conexion->query($query);
        $usuarios = [];
        while ($fila = $resultado->fetch_assoc()) {
            $usuarios[] = $fila;
        }
        return $usuarios;
    }

    // Obtener un usuario por su ID
    public function obtenerUsuarioPorId($id_usuario) {
        $query = "SELECT * FROM Usuarios WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    // Obtener un usuario por su correo electrónico
    public function obtenerUsuarioPorCorreo($correo_electronico) {
        $query = "SELECT * FROM Usuarios WHERE correo_electronico = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("s", $correo_electronico);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    // Actualizar un usuario
    public function actualizarUsuario($id_usuario, $nombreuser, $correo_electronico, $password) {
        $query = "UPDATE Usuarios SET nombreuser = ?, correo_electronico = ?, password = ? WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("sssi", $nombreuser, $correo_electronico, $password, $id_usuario);

        if ($stmt->execute()) {
            echo "Usuario actualizado con éxito.";
        } else {
            echo "Error al actualizar usuario: " . $stmt->error;
        }

        $stmt->close();
    }

    // Eliminar un usuario
    public function eliminarUsuario($id_usuario) {
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

    // Obtener los paquetes de un usuario
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
