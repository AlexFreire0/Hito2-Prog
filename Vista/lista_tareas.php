<?php
session_start();
require_once '../controlador/TareasController.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../sesion/login.php');
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: ../sesion/login.php');
    exit();
}

$controller = new TareasController();
$tareas = $controller->listarTareasPorUsuario($_SESSION['usuario_id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Tareas Registradas</h1>
        <form method="POST" action="lista_tareas.php">
            <button type="submit" name="logout" class="btn btn-danger mb-3">Cerrar Sesión</button>
        </form>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Nombre tarea</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tareas as $tarea): ?>
                    <tr>
                        <td><?= htmlspecialchars($tarea['nombre']) ?></td>
                        <td><?= htmlspecialchars($tarea['descripcion']) ?></td>
                        <?php if ($tarea['Estado'] == 'Pendiente'): ?>
                        <td class="text-danger"><?= htmlspecialchars($tarea['Estado']) ?></td>
                        <?php else: ?>
                        <td class="text-success"><?= htmlspecialchars($tarea['Estado']) ?></td>
                        <?php endif; ?>
                        <td>
                        <?php if ($tarea['Estado'] == 'Pendiente'): ?>
                            <a href="completar_tarea.php?id=<?= urlencode($tarea['id']) ?>" class="btn btn-sm btn-success">Completar</a>
                            <?php else: ?>
                            <a href="nocompletar_tarea.php?id=<?= urlencode($tarea['id']) ?>" class="btn btn-sm btn-warning">No completar</a>
                            <?php endif; ?>  
                            <a href="eliminar_tarea.php?id=<?= urlencode($tarea['id']) ?>" class="btn btn-sm btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="text-center mt-4">
            <a href="alta_tarea.php" class="btn btn-primary">Agregar una nueva tarea</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

