<?php
require_once '../modelo/class_usuario.php';

// Controlador para gestionar usuarios
class UsuariosController {
    private $modelo;

    // Constructor para inicializar el modelo
    public function __construct() {
        $this->modelo = new Usuario();
    }

    // Método para agregar un nuevo usuario
    public function agregarUsuario($nombreuser, $correo_electronico, $password) {
        $this->modelo->agregarUsuario($nombreuser, $correo_electronico, $password);
    }

    // Método para listar todos los usuarios
    public function listarUsuarios() {
        return $this->modelo->obtenerUsuarios();
    }

    // Método para obtener un usuario por su ID
    public function obtenerUsuarioPorId($id_usuario) {
        return $this->modelo->obtenerUsuarioPorId($id_usuario);
    }

    // Método para actualizar la información de un usuario
    public function actualizarUsuario($id_usuario, $nombreuser, $correo_electronico, $password) {
        $this->modelo->actualizarUsuario($id_usuario, $nombreuser, $correo_electronico, $password);
    }

    // Método para eliminar un usuario
    public function eliminarUsuario($id_usuario) {
        $this->modelo->eliminarUsuario($id_usuario);
    }

    // Método para obtener los paquetes asociados a un usuario
    public function obtenerPaquetesUsuario($id_usuario) {
        return $this->modelo->obtenerPacksUsuario($id_usuario);
    }

    // Método para obtener un usuario por su correo electrónico
    public function obtenerUsuarioPorCorreo($correo_electronico) {
        return $this->modelo->obtenerUsuarioPorCorreo($correo_electronico);
    }
}
?>

