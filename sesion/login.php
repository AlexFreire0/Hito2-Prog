<?php
session_start();
require_once '../Controlador/UsuariosController.php';

// Verificar si el usuario ya ha iniciado sesión
if (isset($_SESSION['usuario_id'])) {
    header('Location: ../Vista/lista_tareas.php');
    exit();
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo_electronico = $_POST['correo_electronico'];
    $password = $_POST['password'];

    $controller = new UsuariosController();
    $usuario = $controller->obtenerUsuarioPorCorreo($correo_electronico);

    // Verificar la contraseña y establecer las variables de sesión si es válida
    if ($usuario && password_verify($password, $usuario['password'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombreuser'];
        header('Location: ../Vista/lista_tareas.php');
        exit();
    } else {
        $error_message = '<div class="card card-custom">
        <div class="card-body">
          <p class="card-text text-danger">Correo o contraseña incorrectos</p>
        </div>
      </div>';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión</title>
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
<a class="inicio-btn" href="..">Inicio</a>
<div class="container">
    <h2 class="mb-4">Iniciar Sesión</h2>
    <?php
    // Mostrar mensaje de error si existe
    if ($error_message) {
        echo $error_message;
    }
    ?>
    <form method="POST" action="login.php">
        <div class="mb-3">
            <label class="form-label">Correo electrónico:</label>
            <input type="email" name="correo_electronico" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Contraseña:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-custom w-100">Iniciar Sesión</button>
    </form>
    <div class="mt-3">
        <a href="register.php">No tengo cuenta</a>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
