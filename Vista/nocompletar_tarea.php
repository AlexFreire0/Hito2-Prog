<?php
require_once '../controlador/TareasController.php'; 

$controller = new TareasController();

session_start();
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../sesion/login.php');
    exit();
}

// Verificar si se ha proporcionado un ID de tarea válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_tarea = $_GET['id'];
    if (!$id_tarea) {
        echo "Tarea no encontrada.";
        exit();
    } else {
        // Marcar la tarea como no completada
        $controller->noCompletarTarea($id_tarea);
        header("Location: lista_tareas.php"); 
        exit(); 
    }
} else {
    echo "ID de la tarea no proporcionado.";
    exit();
}
?>