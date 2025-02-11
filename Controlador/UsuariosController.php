<?php
require_once '../modelo/class_usuario.php';

class UsuariosController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Usuario();
    }

    public function agregarUsuario($nombreuser, $correo_electronico, $password) {
        $this->modelo->agregarUsuario($nombreuser, $correo_electronico, $password);
    }

    public function listarUsuarios() {
        return $this->modelo->obtenerUsuarios();
    }

    public function obtenerUsuarioPorId($id_usuario) {
        return $this->modelo->obtenerUsuarioPorId($id_usuario);
    }

    public function actualizarUsuario($id_usuario, $nombreuser, $correo_electronico, $password) {
        $this->modelo->actualizarUsuario($id_usuario, $nombreuser, $correo_electronico, $password);
    }

    public function eliminarUsuario($id_usuario) {
        $this->modelo->eliminarUsuario($id_usuario);
    }

    public function obtenerPaquetesUsuario($id_usuario) {
        return $this->modelo->obtenerPacksUsuario($id_usuario);
    }

    public function obtenerUsuarioPorCorreo($correo_electronico) {
        return $this->modelo->obtenerUsuarioPorCorreo($correo_electronico);
    }
}
?>

