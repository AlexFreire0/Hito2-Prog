<?php
require_once '../controlador/TareasController.php'; 

$controller = new TareasController();

session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../sesion/login.php');
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_tarea = $_GET['id'];
    if (!$id_tarea) {
        echo "Tarea no encontrada.";
        exit();
    } else {
        $controller->noCompletarTarea($id_tarea);
        header("Location: lista_tareas.php"); 
        exit(); 
    }
} else {
    echo "ID de la tarea no proporcionado.";
    exit();
}
?>