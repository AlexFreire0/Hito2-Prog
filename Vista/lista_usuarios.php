<?php
require_once '../controlador/UsuariosController.php';
$controller = new UsuariosController();
$usuarios = $controller->listarUsuarios();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
    background: linear-gradient(135deg, #667eea, #764ba2);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-family: 'Arial', sans-serif;
}

.container {
    max-width: 1200px;
    background: rgba(255, 255, 255, 0.1);
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(10px);
    width: 100%;
}

h1 {
    text-align: center;
    font-weight: bold;
    margin-bottom: 20px;
}

.table {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    color: white;
    margin-top: 20px;
}

.table-striped tbody tr:nth-child(odd) {
    background: rgba(103, 27, 110, 0.97);
}

.table-bordered {
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.table-dark {
    background-color:rgb(96, 24, 114);
}

.table-dark th {
    color: #fff;
    font-weight: bold;
}

.table th, .table td {
    padding: 15px;
    text-align: center;
}

.btn {
    padding: 8px 15px;
    font-size: 14px;
    border-radius: 5px;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn-success {
    background-color: #28a745;
    border: none;
}

.btn-success:hover {
    background-color: #218838;
    transform: scale(1.05);
}

.btn-warning {
    background-color: #ffc107;
    border: none;
}

.btn-warning:hover {
    background-color: #e0a800;
    transform: scale(1.05);
}

.btn-danger {
    background-color: #dc3545;
    border: none;
}

.btn-danger:hover {
    background-color: #c82333;
    transform: scale(1.05);
}

.btn-primary {
    background-color: #ff7eb3;
    border: none;
}

.btn-primary:hover {
    background-color: #ff4f81;
}

.text-center {
    text-align: center;
}

.mt-5 {
    margin-top: 5rem;
}

.mt-4 {
    margin-top: 2rem;
}

    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Usuarios Registrados</h1>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Fecha de nacimiento</th>
                    <th>Plan</th>
                    <th>Duracion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario['id']) ?></td>
                        <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                        <td><?= htmlspecialchars($usuario['apellidos']) ?></td>
                        <td><?= htmlspecialchars($usuario['correo_electronico']) ?></td>
                        <td><?= htmlspecialchars($usuario['fecha_nacimiento']) ?></td>
                        <td><?= htmlspecialchars($usuario['plan_base']) ?></td>
                        <td><?= htmlspecialchars($usuario['duracion_suscripcion']) ?></td>
                        <td>
                            <a href="informacion_usuario.php?id=<?= urlencode($usuario['id']) ?>" class="btn btn-sm btn-success">Información</a>
                            <a href="editar_usuario.php?id=<?= urlencode($usuario['id']) ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="eliminar_usuario.php?id=<?= urlencode($usuario['id']) ?>" class="btn btn-sm btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="text-center mt-4">
            <a href="alta_usuario.php" class="btn btn-primary">Agregar un nuevo usuario</a>
        </div>
    </div>
    <br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

