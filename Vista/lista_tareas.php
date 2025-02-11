<?php
require_once '../controlador/EventosController.php';
$controller = new EventosController();
$eventos = $controller->listarEventos();
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
        <h1 class="mb-4 text-center">Eventos Registrados</h1>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Nombre tarea</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                    <th>Lugar</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($eventos as $evento): ?>
                    <tr>
                        <td><?= htmlspecialchars($evento['id_evento']) ?></td>
                        <td><?= htmlspecialchars($evento['nombre_evento']) ?></td>
                        <td><?= htmlspecialchars($evento['fecha']) ?></td>
                        <td><?= htmlspecialchars($evento['lugar']) ?></td>
                        <td>
                            <a href="editar_evento.php?id=<?= urlencode($evento['id_evento']) ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="eliminar_evento.php?id=<?= urlencode($evento['id_evento']) ?>" class="btn btn-sm btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="text-center mt-4">
            <a href="alta_evento.php" class="btn btn-primary">Agregar un nuevo evento</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

