<?php
session_start();
require_once '../controlador/TareasController.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../sesion/login.php');
    exit();
}

// Manejar el envío del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_tarea = htmlspecialchars($_POST['nombre_tarea']);
    $descripcion = htmlspecialchars($_POST['descripcion']);
    $estado = htmlspecialchars($_POST['estado']);

    $controller = new TareasController();
    // Agregar tarea para el usuario que ha iniciado sesión
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
    <link href="../css/style.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .btn-custom {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
            text-decoration: none;
        }
        .btn-custom:hover {
            background: linear-gradient(135deg, #0056b3, #003f7f);
            transform: scale(1.1);
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
        }
    </style>
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
                <button type="submit" class="btn btn-custom">Guardar</button>
                <a href="lista_tareas.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
