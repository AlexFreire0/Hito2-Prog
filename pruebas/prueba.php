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
    $plan_base = htmlspecialchars($_POST['plan']);
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
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .plans-container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .plan {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            width: 250px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
            cursor: pointer;
        }
        .plan:hover {
            transform: translateY(-10px);
        }
        .plan-header {
            font-size: 1.5em;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        .plan-price {
            font-size: 2em;
            font-weight: bold;
            color: #27ae60;
            margin-bottom: 15px;
        }
        .plan-features {
            list-style: none;
            padding: 0;
            margin-bottom: 20px;
        }
        .plan-features li {
            margin: 10px 0;
        }
        .plan-button {
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .plan-button:hover {
            background-color: #2ecc71;
        }
        input[type="radio"] {
            display: none;
        }
        input[type="radio"]:checked + .plan {
            border-color: #27ae60;
            box-shadow: 0 4px 10px rgba(39, 174, 96, 0.3);
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
              <h5 style="text-align: center;">Plan a contratar</h3>
              <br>
            <div class="plans-container">
              
            <label for="plan_base">
                <input type="radio" name="plan" value="Basico" id="plan_basico"> <!-- Aquí agregamos checked -->
                    <div class="plan">
                        <div class="plan-header">Básico</div>
                        <div class="plan-price">9.99€/mes</div>
                    <ul class="plan-features">
                    <li>1 Dispositivo</li>
                    <li>Acceso a 1 solo pack</li>
                    <li>Soporte estándar</li>
                </ul>
            </div>
        </label>

        <label>
            <input type="radio" name="plan" value="Estándar">
            <div class="plan">
                <div class="plan-header">Estándar</div>
                <div class="plan-price">13,99€/mes</div>
                <ul class="plan-features">
                    <li>2 Dispositivos</li>
                    <li>Acceso a más de un pack</li>
                    <li>Soporte prisritario</li>
                </ul>
            </div>
        </label>
        <label>
            <input type="radio" name="plan" value="Premium">
            <div class="plan">
                <div class="plan-header">Premium</div>
                <div class="plan-price">17,99€/mes</div>
                <ul class="plan-features">
                    <li>4 Dispositivos</li>
                    <li>Acceso a más de un pack</li>
                    <li>Soporte VIP</li>
                </ul>
            </div>
        </label>
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
            </div>

            <div class="form-group d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="lista_socios.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
    <script>
   document.getElementById("plan_base").addEventListener("change", function () {
    const planSeleccionado = this.value;
    const checkboxes = document.querySelectorAll('input[name="paquetes_adicionales[]"]');

    // Desmarcar todos los checkboxes antes de aplicar la nueva lógica
    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
    });

    // Si el plan seleccionado es "Básico", limitamos las opciones a solo uno
    if (planSeleccionado === "Básico") {
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("change", function () {
                if (this.checked) {
                    checkboxes.forEach(otherCheckbox => {
                        if (otherCheckbox !== this) {
                            otherCheckbox.checked = false;  // Solo un checkbox puede estar marcado
                        }
                    });
                }
            });
        });
    } else {
        // Si el plan seleccionado no es "Básico", se pueden marcar varios checkboxes
        checkboxes.forEach(checkbox => {
            checkbox.removeEventListener("change", null); // Eliminar evento de restricción
        });
    }
});

// Cambiar los paquetes adicionales según la edad
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
