<?php
require_once '../controlador/UsuariosController.php'; 

$controller = new UsuariosController();

// Verificar si se ha enviado un ID de usuario válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_usuario = $_GET['id'];
    $usuario = $controller->obtenerUsuarioPorId($id_usuario);

    if (!$usuario) {
        echo "Usuario no encontrado.";
        exit();
    } else {
        $controller->eliminarUsuario($id_usuario);
        header("Location: lista_usuarios.php"); 
        exit(); 
    }
} else {
    echo "ID de usuario no proporcionado.";
    exit();
}
?>