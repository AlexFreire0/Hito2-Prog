<?php
session_start();
require_once '../controlador/TareasController.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../sesion/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_tarea = htmlspecialchars($_POST['nombre_tarea']);
    $descripcion = htmlspecialchars($_POST['descripcion']);
    $estado = htmlspecialchars($_POST['estado']);

    $controller = new TareasController();
    $controller->agregarTarea($nombre_tarea, $descripcion, $estado, $_SESSION['usuario_id']);

    header('Location: lista_tareas.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Agregar una Nueva Tarea</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="nombre_tarea">Nombre de la Tarea</label>
                <input type="text" name="nombre_tarea" id="nombre_tarea" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <select name="estado" id="estado" class="form-control" required>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Completado">Completado</option>
                </select>
            </div>
            <div class="form-group d-flex justify-content-between mt-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="lista_tareas.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
