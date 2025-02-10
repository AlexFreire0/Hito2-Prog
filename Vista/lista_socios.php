<?php
require_once '../controlador/SociosController.php';
$controller = new SociosController();
$socios = $controller->listarSocios();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Socios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Socios Registrados</h1>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Tel&eacute;fono</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($socios as $socio): ?>
                    <tr>
                        <td><?= htmlspecialchars($socio['id_socio']) ?></td>
                        <td><?= htmlspecialchars($socio['nombre']) ?></td>
                        <td><?= htmlspecialchars($socio['apellido']) ?></td>
                        <td><?= htmlspecialchars($socio['email']) ?></td>
                        <td><?= htmlspecialchars($socio['telefono']) ?></td>
                        <td><?= htmlspecialchars($socio['fecha_nacimiento']) ?></td>
                        <td>
                            <a href="editar_socio.php?id=<?= urlencode($socio['id_socio']) ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="eliminar_socio.php?id=<?= urlencode($socio['id_socio']) ?>" class="btn btn-sm btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="text-center mt-4">
            <a href="alta_socio.php" class="btn btn-primary">Agregar un nuevo socio</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

