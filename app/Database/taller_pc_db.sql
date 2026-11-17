CREATE DATABASE IF NOT EXISTS taller_pc_db;

USE taller_pc_db;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO usuarios (id, usuario, password) VALUES
(1, 'admin', '12345');

CREATE TABLE reparaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_nombre VARCHAR(100) NOT NULL,
    equipo VARCHAR(100) NOT NULL,
    problema TEXT NOT NULL,
    solucion TEXT,
    estado ENUM('en_curso', 'finalizada') DEFAULT 'en_curso',
    fecha_ingreso DATETIME NOT NULL,
    fecha_salida DATETIME
);