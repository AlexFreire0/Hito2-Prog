Drop database if exists Hito_programacion;
CREATE DATABASE Hito_programacion;
USE Hito_programacion;

CREATE TABLE Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    correo_electronico VARCHAR(100) NOT NULL UNIQUE,
    fecha_nacimiento date NOT NULL,
    plan_base ENUM('Básico', 'Estándar', 'Premium') NOT NULL,
    duracion_suscripcion ENUM('Mensual', 'Anual') NOT NULL
);

CREATE TABLE Paquetes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    precio_mensual DECIMAL(5, 2) NOT NULL
);

CREATE TABLE Usuarios_Paquetes (
    usuario_id INT,
    paquete_id INT,
    PRIMARY KEY (usuario_id, paquete_id),
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (paquete_id) REFERENCES Paquetes(id) ON DELETE CASCADE
);

INSERT INTO Paquetes (nombre, precio_mensual) VALUES
('Deporte', 6.99),
('Cine', 7.99),
('Infantil', 4.99);

INSERT INTO Usuarios (nombre, apellidos, correo_electronico, fecha_nacimiento, plan_base, duracion_suscripcion) VALUES
('Juan', 'Pérez', 'juan.perez@example.com', '1997-03-15', 'Estándar', 'mensual'),
('María', 'González', 'maria.gonzalez@example.com', '1991-08-23', 'Premium', 'anual'),
('Carlos', 'López', 'carlos.lopez@example.com', '2003-11-10', 'Básico', 'mensual'),
('Ana', 'Martínez', 'ana.martinez@example.com', '1995-05-04', 'Estándar', 'anual'),
('Luis', 'Ramírez', 'luis.ramirez@example.com', '2000-09-28', 'Básico', 'mensual'),
('Elena', 'Torres', 'elena.torres@example.com', '1998-12-01', 'Premium', 'anual'),
('Miguel', 'Sánchez', 'miguel.sanchez@example.com', '1994-07-19', 'Estándar', 'mensual'),
('Laura', 'Díaz', 'laura.diaz@example.com', '1996-02-12', 'Básico', 'anual'),
('Jorge', 'Hernández', 'jorge.hernandez@example.com', '1992-10-30', 'Premium', 'mensual'),
('Sara', 'Ruiz', 'sara.ruiz@example.com', '1999-04-25', 'Estándar', 'anual'),
('David', 'García', 'david.garcia@example.com', '2001-06-18', 'Básico', 'mensual'),
('Paula', 'Fernández', 'paula.fernandez@example.com', '1993-11-07', 'Premium', 'anual'),
('Andrés', 'Morales', 'andres.morales@example.com', '1997-01-29', 'Estándar', 'mensual'),
('Natalia', 'Ortega', 'natalia.ortega@example.com', '1990-05-14', 'Básico', 'anual'),
('Sergio', 'Castro', 'sergio.castro@example.com', '2002-08-21', 'Premium', 'mensual');

-- Insertar Paquetes para los usuarios, respetando las restricciones

-- Para los usuarios menores de 18 años (solo pueden contratar el Pack Infantil)
INSERT INTO Usuarios_Paquetes (usuario_id, paquete_id) VALUES
(3, 3),  -- Carlos López (2003-11-10) (tiene 21 años, no es menor de edad)
(5, 3),  -- Luis Ramírez (2000-09-28) (tiene 24 años, no es menor de edad)
(7, 3),  -- Miguel Sánchez (1994-07-19) (tiene 30 años, no es menor de edad)
(10, 3), -- Sara Ruiz (1999-04-25) (tiene 25 años, no es menor de edad)
(11, 3), -- David García (2001-06-18) (tiene 23 años, no es menor de edad)
(13, 3), -- Natalia Ortega (1990-05-14) (tiene 34 años, no es menor de edad)
(3, 1),  -- Carlos López (Paquete Deporte)
(5, 1),  -- Luis Ramírez (Paquete Deporte)
(11, 2), -- David García (Paquete Cine)
(2, 1),  -- María González (Paquete Deporte)
(4, 1),  -- Ana Martínez (Paquete Deporte)
(6, 1),  -- Elena Torres (Paquete Deporte)
(8, 1),  -- Laura Díaz (Paquete Deporte)
(9, 1),  -- Jorge Hernández (Paquete Deporte)
(12, 1), -- Paula Fernández (Paquete Deporte)
(14, 1); -- Andrés Morales (Paquete Deporte)

SELECT * FROM Usuarios;

SELECT * FROM Usuarios_Paquetes
order by usuario_id desc
