<?php
session_start();
require_once '../config/db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombreuser = $_POST['nombreuser'];
    $correo_electronico = $_POST['correo_electronico'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $conexion = new Conexion();
    $query = "INSERT INTO Usuarios (nombreuser, correo_electronico, password) VALUES (?, ?, ?)";
    $stmt = $conexion->conexion->prepare($query);
    $stmt->bind_param("sss", $nombreuser, $correo_electronico, $password);

    if ($stmt->execute()) {
        echo "Usuario registrado con éxito.";
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
    }

    $stmt->close();
    $conexion->conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
    <!-- Bootstrap CSS -->
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
                    <a href="login.php">¿Ya tienes cuenta? Inicia sesión</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (Opcional, solo si usas componentes interactivos como modales) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
