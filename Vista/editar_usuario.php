<?php
require_once '../controlador/UsuariosController.php';

$controller = new UsuariosController();

// Verificar si se ha enviado un ID de usuario válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_usuario = $_GET['id'];
    $usuario = $controller->obtenerUsuarioPorId($id_usuario);

    if (!$usuario) {
        echo "Usuario no encontrado.";
        exit();
    }

    // Obtener los paquetes adicionales del usuario
    $paquetes_usuario = $controller->obtenerPaquetesUsuario($id_usuario);
    $paquetes_seleccionados = array_column($paquetes_usuario, 'paquete_id'); // Extraer los IDs de los paquetes
} else {
    echo "ID de usuario no proporcionado.";
    exit();
}

// Procesar el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido = htmlspecialchars($_POST['apellido']);
    $correo_electronico = htmlspecialchars($_POST['correo_electronico']);
    $fecha_nacimiento = new DateTime($_POST['fecha_nacimiento']);
    $plan_base = htmlspecialchars($_POST['plan_base']);
    $duracion_suscripcion = htmlspecialchars($_POST['duracion_suscripcion']);
    $paquetes_adicionales = isset($_POST['paquetes_adicionales']) ? $_POST['paquetes_adicionales'] : [];

    // Convertir los nombres de los paquetes a números
    $paquetes_adicionales_convertidos = [];
    foreach ($paquetes_adicionales as $paquete) {
        switch ($paquete) {
            case 'Deporte':
                $paquetes_adicionales_convertidos[] = 1;
                break;
            case 'Cine':
                $paquetes_adicionales_convertidos[] = 2;
                break;
            case 'Infantil':
                $paquetes_adicionales_convertidos[] = 3;
                break;
            default:
                // Si no coincide con ninguno de los casos, no agregarlo
                break;
        }
    }

    // Actualizar el usuario
    $controller->actualizarUsuario($id_usuario, $nombre, $apellido, $correo_electronico, $fecha_nacimiento, $plan_base, $duracion_suscripcion, $paquetes_adicionales_convertidos);

    // Redirigir a la lista de usuarios
    header('Location: lista_usuarios.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
        .container {
            max-width: 600px;
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }
        h1 {
            text-align: center;
            font-weight: bold;
        }
        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
        }
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        .btn-primary {
            background-color: #ff7eb3;
            border: none;
        }
        .btn-primary:hover {
            background-color: #ff4f81;
        }
        .btn-secondary {
            background-color:rgb(167, 151, 93);
            border: none;
        }
        .btn-secondary:hover {
            background-color:rgb(201, 153, 9);
        }
        .form-control {
    background: rgba(255, 255, 255, 0.2);  /* Fondo semi-transparente */
    border: none;
    color: white;  /* Mantener texto blanco */
    font-size: 16px;  /* Ajustar tamaño de fuente si es necesario */
    padding: 10px;  /* Espaciado cómodo */
    border-radius: 5px;  /* Bordes redondeados */
    transition: background-color 0.3s ease;  /* Transición suave */
}

.form-control:focus {
    background: rgba(255, 255, 255, 0.3);  /* Fondo más claro cuando está enfocado */
    color: white;  /* Mantener el texto blanco al enfocarse */
    outline: none;  /* Eliminar borde de enfoque predeterminado */
}

.form-control::placeholder {
    color: rgba(255, 255, 255, 0.7);  /* Gris claro para el texto del placeholder */
    opacity: 1;  /* Asegura que el placeholder sea visible */
}
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Editar Usuario</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" id="apellido" class="form-control" value="<?php echo htmlspecialchars($usuario['apellidos']); ?>" required>
            </div>
            <div class="form-group">
                <label for="correo_electronico">Correo Electrónico</label>
                <input type="email" name="correo_electronico" id="correo_electronico" class="form-control" value="<?php echo htmlspecialchars($usuario['correo_electronico']); ?>" required>
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="<?php echo htmlspecialchars($usuario['fecha_nacimiento']); ?>" required max="2025-01-31">
            </div>
            <div class="form-group">
                <label for="plan_base">Plan Base</label>
                <select name="plan_base" id="plan_base" class="form-control" required>
                    <option value="Básico" <?php echo ($usuario['plan_base'] === 'Básico') ? 'selected' : ''; ?>>Plan Básico (1 dispositivo) 9,99€/mes</option>
                    <option value="Estándar" <?php echo ($usuario['plan_base'] === 'Estándar') ? 'selected' : ''; ?>>Plan Estándar (2 dispositivos) 13,99€/mes</option>
                    <option value="Premium" <?php echo ($usuario['plan_base'] === 'Premium') ? 'selected' : ''; ?>>Plan Premium (4 dispositivos) 17,99€/mes</option>
                </select>
            </div>
            <div class="form-group">
                <label for="duracion_suscripcion">Duración de la Suscripción</label>
                <select name="duracion_suscripcion" id="duracion_suscripcion" class="form-control" required>
                    <option value="Mensual" <?php echo ($usuario['duracion_suscripcion'] === 'Mensual') ? 'selected' : ''; ?>>Mensual</option>
                    <option value="Anual" <?php echo ($usuario['duracion_suscripcion'] === 'Anual') ? 'selected' : ''; ?>>Anual</option>
                </select>
            </div>
            <div class="form-group" id="paquetes">
                <label for="paquetes_adicionales">Paquetes Adicionales</label>
                <div class="form-check">
                    <input type="checkbox" name="paquetes_adicionales[]" value="Deporte" id="paquete_deporte" class="form-check-input" <?php echo (in_array(1, $paquetes_seleccionados)) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="paquete_deporte">Deporte 6,99€</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="paquetes_adicionales[]" value="Cine" id="paquete_cine" class="form-check-input" <?php echo (in_array(2, $paquetes_seleccionados)) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="paquete_cine">Cine 7,99€</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="paquetes_adicionales[]" value="Infantil" id="paquete_infantil" class="form-check-input" <?php echo (in_array(3, $paquetes_seleccionados)) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="paquete_infantil">Infantil 4,99€</label>
                </div>
            </div>
            <div class="form-group d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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
document.getElementById("paquetes").addEventListener("change", function () {
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
});
// Este código asegura que el checkbox solo se puede seleccionar uno si se elige "Básico"




document.getElementById("fecha_nacimiento").addEventListener("change", function () {
    const fechaNacimiento = new Date(this.value);
    const hoy = new Date();
    const edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
    const contenedorPaquetes = document.getElementById("paquetes");
    if (edad < 18) {
        contenedorPaquetes.innerHTML = `
        <label for="paquetes_adicionales">Paquetes Adicionales</label>
            <div class="form-check">
                <input type="checkbox" name="paquetes_adicionales[]" value="Infantil" id="paquete_infantil" class="form-check-input">
                <label class="form-check-label" for="paquete_infantil">Infantil 4,99€</label>
            </div>
        `;
    } else {
        if(document.getElementById('duracion_suscripcion').value !== "Mensual") {
        // Mostrar todas las opciones si el usuario es mayor de 18 años
        contenedorPaquetes.innerHTML = `
           <label for="paquetes_adicionales">Paquetes Adicionales</label>
            <div class="form-check">
                <input type="checkbox" name="paquetes_adicionales[]" value="Deporte" id="paquete_deporte" class="form-check-input">
                <label class="form-check-label" for="paquete_deporte">Deporte 6,99€</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="paquetes_adicionales[]" value="Cine" id="paquete_cine" class="form-check-input">
                <label class="form-check-label" for="paquete_cine">Cine 7,99€</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="paquetes_adicionales[]" value="Infantil" id="paquete_infantil" class="form-check-input">
                <label class="form-check-label" for="paquete_infantil">Infantil 4,99€</label>
            </div>
        `;}
        else {
            contenedorPaquetes.innerHTML = `
           <label for="paquetes_adicionales">Paquetes Adicionales</label>
            <div class="form-check">
                <input type="checkbox" name="paquetes_adicionales[]" value="Cine" id="paquete_cine" class="form-check-input">
                <label class="form-check-label" for="paquete_cine">Cine 7,99€</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="paquetes_adicionales[]" value="Infantil" id="paquete_infantil" class="form-check-input">
                <label class="form-check-label" for="paquete_infantil">Infantil 4,99€</label>
            </div>
        `; 
        }
    }
    
});
document.addEventListener("DOMContentLoaded", function () {
    // Obtener la fecha de hoy en formato YYYY-MM-DD
    const hoy = new Date().toISOString().split("T")[0];
    document.getElementById("fecha_nacimiento").setAttribute("max", hoy);
});


document.getElementById("duracion_suscripcion").addEventListener("change", function  () {
    const duracionSeleccionada = this.value;
    const fechaNacimiento = new Date(document.getElementById('fecha_nacimiento').value);
    const hoy = new Date();
    const edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
    if (edad > 18) {
        if (duracionSeleccionada === "Mensual") {
            document.getElementById("paquetes").innerHTML = `
                   <label for="paquetes_adicionales">Paquetes Adicionales</label>
                   <div class="form-check">
                       <input type="checkbox" name="paquetes_adicionales[]" value="Cine" id="paquete_cine" class="form-check-input">
                       <label class="form-check-label" for="paquete_cine">Cine 7,99€</label>
                   </div>
                   <div class="form-check">
                       <input type="checkbox" name="paquetes_adicionales[]" value="Infantil" id="paquete_infantil" class="form-check-input">
                       <label class="form-check-label" for="paquete_infantil">Infantil 4,99€</label>
                   </div>
            `;
        } else {
            document.getElementById("paquetes").innerHTML = `
                   <label for="paquetes_adicionales">Paquetes Adicionales</label>
                   <div class="form-check">
                       <input type="checkbox" name="paquetes_adicionales[]" value="Deporte" id="paquete_deporte" class="form-check-input">
                       <label class="form-check-label" for="paquete_deporte">Deporte 6,99€</label>
                   </div>
                   <div class="form-check">
                       <input type="checkbox" name="paquetes_adicionales[]" value="Cine" id="paquete_cine" class="form-check-input">
                       <label class="form-check-label" for="paquete_cine">Cine 7,99€</label>
                   </div>
                   <div class="form-check">
                       <input type="checkbox" name="paquetes_adicionales[]" value="Infantil" id="paquete_infantil" class="form-check-input">
                       <label class="form-check-label" for="paquete_infantil">Infantil 4,99€</label>
                   </div>
            `;
        }
    } else {
        document.getElementById("paquetes").innerHTML = `
                   <label for="paquetes_adicionales">Paquetes Adicionales</label>
                   <div class="form-check">
                       <input type="checkbox" name="paquetes_adicionales[]" value="Infantil" id="paquete_infantil" class="form-check-input">
                       <label class="form-check-label" for="paquete_infantil">Infantil 4,99€</label>
                   </div>
            `; 
    }
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
function iniciar_duracion() {
    const duracionSeleccionada = document.getElementById("duracion_suscripcion").value;
    const fechaNacimiento = new Date(document.getElementById('fecha_nacimiento').value);
    const hoy = new Date();
    const edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
    if (edad > 18) {
        if (duracionSeleccionada === "Mensual") {
            document.getElementById("paquetes").innerHTML = `
                   <label for="paquetes_adicionales">Paquetes Adicionales</label>
                <div class="form-check">
                    <input type="checkbox" name="paquetes_adicionales[]" value="Cine" id="paquete_cine" class="form-check-input" <?php echo (in_array(2, $paquetes_seleccionados)) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="paquete_cine">Cine 7,99€</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="paquetes_adicionales[]" value="Infantil" id="paquete_infantil" class="form-check-input" <?php echo (in_array(3, $paquetes_seleccionados)) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="paquete_infantil">Infantil 4,99€</label>
                </div>
            `;
        } else {
            document.getElementById("paquetes").innerHTML = `
               <label for="paquetes_adicionales">Paquetes Adicionales</label>
                <div class="form-check">
                    <input type="checkbox" name="paquetes_adicionales[]" value="Deporte" id="paquete_deporte" class="form-check-input" <?php echo (in_array(1, $paquetes_seleccionados)) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="paquete_deporte">Deporte 6,99€</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="paquetes_adicionales[]" value="Cine" id="paquete_cine" class="form-check-input" <?php echo (in_array(2, $paquetes_seleccionados)) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="paquete_cine">Cine 7,99€</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="paquetes_adicionales[]" value="Infantil" id="paquete_infantil" class="form-check-input" <?php echo (in_array(3, $paquetes_seleccionados)) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="paquete_infantil">Infantil 4,99€</label>
                </div>
            `;
        }
    } else {
        document.getElementById("paquetes").innerHTML = `
                   <label for="paquetes_adicionales">Paquetes Adicionales</label>
                <div class="form-check">
                    <input type="checkbox" name="paquetes_adicionales[]" value="Infantil" id="paquete_infantil" class="form-check-input" <?php echo (in_array(3, $paquetes_seleccionados)) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="paquete_infantil">Infantil 4,99€</label>
                </div>
            `; 
    }
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
}
function iniciar_fecha() {
    const fechaNacimiento = new Date(document.getElementById('fecha_nacimiento').value);
    const hoy = new Date();
    const edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
    const contenedorPaquetes = document.getElementById("paquetes");
    if (edad < 18) {
        contenedorPaquetes.innerHTML = `
               <label for="paquetes_adicionales">Paquetes Adicionales</label>
                <div class="form-check">
                    <input type="checkbox" name="paquetes_adicionales[]" value="Infantil" id="paquete_infantil" class="form-check-input" <?php echo (in_array(3, $paquetes_seleccionados)) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="paquete_infantil">Infantil 4,99€</label>
                </div>
        `;
    } else {
        // Mostrar todas las opciones si el usuario es mayor de 18 años
        contenedorPaquetes.innerHTML = `
               <label for="paquetes_adicionales">Paquetes Adicionales</label>
                <div class="form-check">
                    <input type="checkbox" name="paquetes_adicionales[]" value="Deporte" id="paquete_deporte" class="form-check-input" <?php echo (in_array(1, $paquetes_seleccionados)) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="paquete_deporte">Deporte 6,99€</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="paquetes_adicionales[]" value="Cine" id="paquete_cine" class="form-check-input" <?php echo (in_array(2, $paquetes_seleccionados)) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="paquete_cine">Cine 7,99€</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="paquetes_adicionales[]" value="Infantil" id="paquete_infantil" class="form-check-input" <?php echo (in_array(3, $paquetes_seleccionados)) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="paquete_infantil">Infantil 4,99€</label>
                </div>
        `;
    }
    return "menor"
};

document.addEventListener("DOMContentLoaded", function () {
    iniciar_duracion();
    iniciar_fecha();
});




    </script>    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>