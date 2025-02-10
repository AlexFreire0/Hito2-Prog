<?php
require_once '../modelo/class_usuario.php';

class UsuariosController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Usuario();
    }

    public function agregarUsuario($nombre, $apellido, $correo_electronico , $fecha_nacimiento, $plan_base, $duracion_suscripcion, $paquetes_adicionales) {
        $this->modelo->agregarUsuario($nombre, $apellido, $correo_electronico, $fecha_nacimiento, $plan_base, $duracion_suscripcion, $paquetes_adicionales);
        
    }

    public function listarUsuarios() {
        return $this->modelo->obtenerUsuarios();
    }

    public function obtenerUsuarioPorId($id_usuario) {
        return $this->modelo->obtenerUsuarioPorId($id_usuario);
    }

    public function actualizarUsuario($id_usuario, $nombre, $apellido, $correo_electronico, $fecha_nacimiento, $plan_base, $duracion_suscripcion, $paquetes_adicionales_convertidos) {
        $this->modelo->actualizarUsuario($id_usuario, $nombre, $apellido, $correo_electronico, $fecha_nacimiento, $plan_base, $duracion_suscripcion, $paquetes_adicionales_convertidos);
    }

    public function eliminarUsuario($id_usuario) {
        $this->modelo->eliminarUsuario($id_usuario);
    }
    public function obtenerPaquetesUsuario($id_usuario) {
        return $this->modelo->obtenerPacksUsuario($id_usuario);
    }
}
?>

