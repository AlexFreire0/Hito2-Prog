Drop database if exists Hito_programacion2;
CREATE DATABASE Hito_programacion2;
USE Hito_programacion2;

CREATE TABLE Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombreuser VARCHAR(100) NOT NULL,
    correo_electronico VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE Tareas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    descripcion VARCHAR(500),
    Estado Enum("Completado", "Pendiente") NOT NULL
);

CREATE TABLE Usuarios_Tareas (
    usuario_id INT,
    tarea_id INT,
    PRIMARY KEY (usuario_id, tarea_id),
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (tarea_id) REFERENCES Tareas(id) ON DELETE CASCADE
);

SELECT * FROM Usuarios;

SELECT * FROM Usuarios_Tareas
order by usuario_id desc
