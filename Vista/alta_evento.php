<?php
require_once '../controlador/EventosController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_evento = htmlspecialchars($_POST['nombre_evento']);
    $fecha = htmlspecialchars($_POST['fecha']);
    $lugar = htmlspecialchars($_POST['lugar']);

    $controller = new EventosController();
    $controller->agregarEvento($nombre_evento, $fecha, $lugar);

    header('Location: lista_eventos.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Evento</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Agregar un Nuevo Socio</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="nombre_evento">Nombre Del Evento</label>
                <input type="text" name="nombre_evento" id="nombre_evento" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="lugar">Lugar</label>
                <input type="lugar" name="lugar" id="lugar" class="form-control" required>
            </div>
            <div class="form-group d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="lista_socios.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
