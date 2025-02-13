<?php
session_start();
require_once '../controlador/TareasController.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../sesion/login.php');
    exit();
}

// Manejar el cierre de sesión
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: ../sesion/login.php');
    exit();
}

$controller = new TareasController();
// Obtener las tareas del usuario que ha iniciado sesión
$tareas = $controller->listarTareasPorUsuario($_SESSION['usuario_id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Tareas</title>
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
        .btn-logout {
            background: linear-gradient(135deg, #ff4b4b, #b30000);
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
        .btn-logout:hover {
            background: linear-gradient(135deg, #b30000, #800000);
            transform: scale(1.1);
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
        }
        .btn-completar {
            background: linear-gradient(135deg, #28a745, #218838);
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
            text-decoration: none;
        }
        .btn-completar:hover {
            background: linear-gradient(135deg, #218838, #1e7e34);
            transform: scale(1.1);
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
        }
        .btn-nocompletar {
            background: linear-gradient(135deg, #ffc107, #e0a800);
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
            text-decoration: none;
        }
        .btn-nocompletar:hover {
            background: linear-gradient(135deg, #e0a800, #c69500);
            transform: scale(1.1);
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
        }
        .btn-eliminar {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
            text-decoration: none;
        }
        .btn-eliminar:hover {
            background: linear-gradient(135deg, #c82333, #bd2130);
            transform: scale(1.1);
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Tareas Registradas</h1>
        <form method="POST" action="lista_tareas.php">
            <button type="submit" name="logout" class="btn btn-logout mb-3">Cerrar Sesión</button>
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
                            <a href="completar_tarea.php?id=<?= urlencode($tarea['id']) ?>" class="btn btn-completar">Completar</a>
                            <?php else: ?>
                            <a href="nocompletar_tarea.php?id=<?= urlencode($tarea['id']) ?>" class="btn btn-nocompletar">No completar</a>
                            <?php endif; ?>  
                            <a href="eliminar_tarea.php?id=<?= urlencode($tarea['id']) ?>" class="btn btn-eliminar">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="text-center mt-4">
            <a href="alta_tarea.php" class="btn btn-custom">Agregar una nueva tarea</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

