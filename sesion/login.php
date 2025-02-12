<?php
session_start();
require_once '../Controlador/UsuariosController.php';

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
</head>
<body class="bg-light">
<a class="inicio-btn" href="..">Inicio</a>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h2>Iniciar Sesión</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="login.php">
                        <div class="mb-3">
                            <label class="form-label">Correo electrónico:</label>
                            <input type="email" name="correo_electronico" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contraseña:</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="register.php">No tengo cuenta</a>
                </div>
            </div>
        </div>
        </div>
            <?php
            if ($error_message) {
                echo $error_message;
            }
            ?>
        </div>
    </div>
</div>
<!-- Bootstrap JS (Opcional, solo si usas componentes interactivos como modales) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
