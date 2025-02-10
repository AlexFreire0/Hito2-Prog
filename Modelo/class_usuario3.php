<?php
require_once '../config/db_config.php';

class Usuario {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function agregarUsuario($nombre, $apellido, $correo_electronico, $fecha_nacimiento, $plan_base, $duracion_suscripcion) {
        $query = "INSERT INTO Usuarios (nombre, apellidos, correo_electronico, fecha_nacimiento, plan_base, duracion_suscripcion) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("ssssss", $nombre, $apellido, $correo_electronico, $fecha_nacimiento, $plan_base, $duracion_suscripcion);

        if ($stmt->execute()) {
            echo "Usuario agregado con éxito.";
        } else {
            echo "Error al agregar el usuario: " . $stmt->error;
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

    public function actualizarUsuario($id_usuario, $nombre, $apellido, $correo_electronico, $fecha_nacimiento, $plan_base, $duracion_suscripcion) {
        $query = "UPDATE Usuarios SET nombre = ?, apellidos = ?, correo_electronico = ?, fecha_nacimiento = ?, plan_base = ?, duracion_suscripcion = ? WHERE id = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        if ($fecha_nacimiento instanceof DateTime) {
            $fecha_nacimiento = $fecha_nacimiento->format('Y-m-d');
        }
        $stmt->bind_param("ssssssi", $nombre, $apellido, $correo_electronico , $fecha_nacimiento, $plan_base, $duracion_suscripcion, $id_usuario);

        if ($stmt->execute()) {
            echo "Usuario actualizado con éxito.";
        } else {
            echo "Error al actualizar usuario: " . $stmt->error;
        }

        $stmt->close();
    }

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
 #   public function obtenerpacksuser() {
 #       $query = "SELECT 
 #           u.nombre AS Nombre_Usuario,
 #           u.apellidos AS Apellidos_Usuario,
 #           p.nombre AS Nombre_Paquete,
 #           p.precio_mensual AS Precio_Paquete
 #       FROM 
 #           Usuarios u
 #       LEFT JOIN 
 #           Usuarios_Paquetes up ON u.id = up.usuario_id
 #       LEFT JOIN 
 #           Paquetes p ON up.paquete_id = p.id;";
 #       $stmt = $this->conexion->conexion->prepare($query);
 #       $stmt->bind_param("i", $id_usuario);
 #   }
}
?>
