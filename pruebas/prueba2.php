<?php
require_once '../controlador/UsuariosController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar datos del formulario
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido = htmlspecialchars($_POST['apellido']);
    $correo_electronico = htmlspecialchars($_POST['correo_electronico']);
    $fecha_nacimiento = new DateTime($_POST['edad']);
    $hoy = new DateTime();
    $edad = $hoy->diff($fecha_nacimiento)->y;
    $plan_base = htmlspecialchars($_POST['plan_base']);
    $duracion_suscripcion = htmlspecialchars($_POST['duracion_suscripcion']);

    if (empty($nombre) || empty($apellido) || empty($correo_electronico) || empty($edad) || empty($plan_base) || empty($duracion_suscripcion)) {
        die('Por favor, completa todos los campos.');
    }

    $controller = new UsuariosController();
    $controller->agregarUsuario($nombre, $apellido, $correo_electronico , $edad, $plan_base, $duracion_suscripcion);
    
    header('Location: lista_usuarios.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suscribirse</title>
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
        <h1 class="mb-4 text-center">Suscripcion StreamWeb</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="nombre_evento">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nombre_evento">Apellido</label>
                <input type="text" name="apellido" id="apellido" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nombre_evento">Correo Electronico</label>
                <input type="email" name="correo_electronico" id="correo_electronico" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de nacimiento</label>
                <input type="date" name="edad" id="edad" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="plan_base">Plan Base</label>
                <select name="plan_base" id="plan_base" class="form-control" required>
                    <option value="" disabled selected>No seleccionado</option>
                    <option value="Básico">Plan Básico (1 dispositivo) 9,99€/mes</option>
                    <option value="Estándar">Plan Estándar (2 dispositivos) 13,99€/mes</option>
                    <option value="Premium">Plan Premium (4 dispositivos) 17,99€/mes</option>
                </select>
            </div>
            <div class="form-group">
                <label for="duracion_suscripcion">Duración de la Suscripción</label>
                <select name="duracion_suscripcion" id="duracion_suscripcion" class="form-control" required>
                    <option value="" disabled selected>No seleccionado</option>
                    <option value="Mensual">Mensual</option>
                    <option value="Anual">Anual</option>
                </select>
            </div>
            <div class="form-group" id="paquetes">
               <label for="paquetes_adicionales">Paquetes Adicionales</label>
               <div class="form-check">
                   <input type="checkbox" name="paquetes_adicionales[]" value="Deporte" id="paquete_deporte" class="form-check-input">
                   <label class="form-check-label" for="paquete_deporte">Deporte 6,99€</label>
               </div>
               <div class="form-check">
                   <input type="checkbox" name="paquetes_adicionales[]" value="Cine" id="paquete_cine" class="form-check-input">
                   <label class="form-check-label" for="paquete_cine">Cine 7,99</label>
               </div>
               <div class="form-check">
                   <input type="checkbox" name="paquetes_adicionales[]" value="Infantil" id="paquete_infantil" class="form-check-input">
                   <label class="form-check-label" for="paquete_infantil">Infantil 4,99€</label>
               </div>
            </div>

            <div class="form-group d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="lista_usuarios.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
    <script>
   document.getElementById("plan_base").addEventListener("change", function () {
    const planSeleccionado = this.value;
    const checkboxes = document.querySelectorAll('input[name="paquetes_adicionales[]"]');

    // Desmarcar todos los checkboxes si el plan seleccionado es Básico
    if (planSeleccionado === "Básico") {
        checkboxes.forEach(checkbox => {
            checkbox.checked = false; // Desmarcar cada checkbox
        });
    }
});

// Este código asegura que el checkbox solo se puede seleccionar uno si se elige "Básico"
document.querySelectorAll('input[name="paquetes_adicionales[]"]').forEach(function(checkbox) {
    checkbox.addEventListener("change", function() {
        const checkboxes = document.querySelectorAll('input[name="paquetes_adicionales[]"]');
        if (this.checked && document.getElementById("plan_base").value === "Básico") {
            checkboxes.forEach(function(otherCheckbox) {
                if (otherCheckbox !== checkbox) {
                    otherCheckbox.checked = false; // Desmarcar los demás
                }
            });
        }
    });
});


function manejadorCheckboxBásico() {
    const checkboxes = document.querySelectorAll('input[name="paquetes_adicionales[]"]');
    if (this.checked) {
        checkboxes.forEach(otherCheckbox => {
            if (otherCheckbox !== this) {
                otherCheckbox.checked = false;
            }
        });
    }
}


document.getElementById("edad").addEventListener("change", function () {
    const fechaNacimiento = new Date(this.value);
    const hoy = new Date();
    const edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
    const contenedorPaquetes = document.getElementById("paquetes");
    if (edad < 18) {
        contenedorPaquetes.innerHTML = `
        <label for="paquetes_adicionales">Paquetes Adicionales</label>
            <div class="form-check">
                <input type="checkbox" name="paquetes_adicionales[]" value="Infantil" id="paquete_infantil" class="form-check-input">
                <label class="form-check-label" for="paquete_infantil">Infantil</label>
            </div>
        `;
    } else {
        // Mostrar todas las opciones si el usuario es mayor de 18 años
        contenedorPaquetes.innerHTML = `
           <label for="paquetes_adicionales">Paquetes Adicionales</label>
            <div class="form-check">
                <input type="checkbox" name="paquetes_adicionales[]" value="Deporte" id="paquete_deporte" class="form-check-input">
                <label class="form-check-label" for="paquete_deporte">Deporte</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="paquetes_adicionales[]" value="Cine" id="paquete_cine" class="form-check-input">
                <label class="form-check-label" for="paquete_cine">Cine</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="paquetes_adicionales[]" value="Infantil" id="paquete_infantil" class="form-check-input">
                <label class="form-check-label" for="paquete_infantil">Infantil</label>
            </div>
        `;
    }
});

    </script>    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>