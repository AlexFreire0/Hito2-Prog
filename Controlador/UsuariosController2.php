<?php
require_once '../modelo/class_usuario.php';

class UsuariosController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Usuario();
    }

    public function agregarUsuario($nombre, $apellido, $correo_electronico , $fecha_nacimiento, $plan_base, $duracion_suscripcion) {
        $this->modelo->agregarUsuario($nombre, $apellido, $correo_electronico, $fecha_nacimiento, $plan_base, $duracion_suscripcion);
    }

    public function listarUsuarios() {
        return $this->modelo->obtenerUsuarios();
    }

    public function obtenerUsuarioPorId($id_usuario) {
        return $this->modelo->obtenerUsuarioPorId($id_usuario);
    }

    public function actualizarUsuario($id_usuario, $nombre, $apellido, $correo_electronico, $fecha_nacimiento, $plan_base, $duracion_suscripcion) {
        $this->modelo->actualizarUsuario($id_usuario, $nombre, $apellido, $correo_electronico, $fecha_nacimiento, $plan_base, $duracion_suscripcion);
    }

    public function eliminarUsuario($id_usuario) {
        $this->modelo->eliminarUsuario($id_usuario);
    }
}
?>
