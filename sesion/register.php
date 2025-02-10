<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>
    <h2>Registro</h2>
    <form method="POST">
        <label>Nombre de usuario:</label>
        <input type="text" name="nombreuser" required>
        <br>
        <label>Correo electrónico:</label>
        <input type="email" name="correo_electronico" required>
        <br>
        <label>Contraseña:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Registrarse</button>
    </form>
    <a href="login.php">Ya tienes cuenta? Inicia sesión</a>
</body>
</html>