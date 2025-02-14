<?php
// Iniciar sesión
session_start();
// Incluir el controlador de usuarios
require_once '../Controlador/UsuariosController.php';

// Inicializar mensaje de error
$error_message = '';

// Verificar si el método de solicitud es POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $nombreuser = $_POST['nombreuser'];
    $correo_electronico = $_POST['correo_electronico'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Crear instancia del controlador de usuarios
    $controller = new UsuariosController();
    // Verificar si el usuario ya existe por correo electrónico
    $existing_user = $controller->obtenerUsuarioPorCorreo($correo_electronico);

    // Si el usuario ya existe, mostrar mensaje de error
    if ($existing_user) {
        $error_message = '<div class="card card-custom">
        <div class="card-body">
          <p class="card-text text-danger">El correo electronico ya está registrado</p>
        </div>
      </div>';
    } else {
        // Si el usuario no existe, agregar nuevo usuario
        $controller->agregarUsuario($nombreuser, $correo_electronico, $password);
        echo "Usuario registrado con éxito.";
        // Redirigir a la página de inicio de sesión
        header('Location: login.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
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
    <h2 class="mb-4">Registro</h2>
    <?php
    // Mostrar mensaje de error si existe
    if ($error_message) {
        echo $error_message;
    }
    ?>
    <form method="POST" action="register.php">
        <div class="mb-3">
            <label class="form-label">Nombre de usuario:</label>
            <input type="text" name="nombreuser" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Correo electrónico:</label>
            <input type="email" name="correo_electronico" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Contraseña:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-custom w-100">Registrarse</button>
    </form>
    <div class="mt-3">
        <a href="login.php">Ya tengo cuenta</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
