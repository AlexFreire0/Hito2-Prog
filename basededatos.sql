-- Eliminar la base de datos si ya existe
DROP DATABASE IF EXISTS Hito_programacion2;

-- Crear una nueva base de datos
CREATE DATABASE Hito_programacion2;
USE Hito_programacion2;

-- Crear la tabla Usuarios
CREATE TABLE Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombreuser VARCHAR(100) NOT NULL,
    correo_electronico VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Crear la tabla Tareas
CREATE TABLE Tareas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    descripcion VARCHAR(500),
    Estado ENUM("Completado", "Pendiente") NOT NULL
);

-- Crear la tabla Usuarios_Tareas para la relación muchos a muchos entre Usuarios y Tareas
CREATE TABLE Usuarios_Tareas (
    usuario_id INT,
    tarea_id INT,
    PRIMARY KEY (usuario_id, tarea_id),
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (tarea_id) REFERENCES Tareas(id) ON DELETE CASCADE
);

-- Consultar todos los usuarios
SELECT * FROM Usuarios;

-- Consultar todas las relaciones entre usuarios y tareas
SELECT * FROM Usuarios_Tareas
ORDER BY usuario_id DESC;
