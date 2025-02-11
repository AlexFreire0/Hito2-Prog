<?php
session_start();
require_once '../Controlador/UsuariosController.php';

if (isset($_SESSION['usuario_id'])) {
    header('Location: ../Vista/lista_tareas.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombreuser = $_POST['nombreuser'];
    $correo_electronico = $_POST['correo_electronico'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $controller = new UsuariosController();
    $controller->agregarUsuario($nombreuser, $correo_electronico, $password);

    echo "Usuario registrado con éxito.";
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h2>Registro</h2>
                </div>
                <div class="card-body">
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
                        <button type="submit" class="btn btn-primary w-100">Registrarse</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="login.php">Ya tengo cuenta</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
