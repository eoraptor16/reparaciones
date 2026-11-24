CREATE DATABASE municipalidad_incidencias_db;

USE municipalidad_incidencias_db;

CREATE TABLE administradores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    nombre_area VARCHAR(100) NOT NULL
);

INSERT INTO administradores (usuario, password, nombre_area) VALUES
('informatica', '12345', 'Departamento de Informática');

CREATE TABLE departamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    nombre_departamento VARCHAR(100) NOT NULL
);

INSERT INTO departamentos (usuario, password, nombre_departamento) VALUES
('rentas', 'ren101', 'Gerencia de Rentas'),
('obras', 'obr202', 'Gerencia de Obras Públicas'),
('registro_civil', 'rc303', 'Registro Civil'),
('tesoreria', 'tes404', 'Tesorería'),
('contabilidad', 'con505', 'Contabilidad'),
('logistica', 'log606', 'Logística y Abastecimiento'),
('seguridad_ciudadana', 'seg707', 'Seguridad Ciudadana'),
('desarrollo_social', 'des808', 'Desarrollo Social'),
('medio_ambiente', 'med909', 'Medio Ambiente'),
('secretaria_general', 'sec010', 'Secretaría General');

CREATE TABLE incidencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    departamento_id INT NOT NULL,
    equipo_o_recurso VARCHAR(100) NOT NULL,
    tipo_incidencia VARCHAR(50) NOT NULL,
    descripcion TEXT NOT NULL,
    prioridad ENUM('sin_asignar', 'baja', 'media', 'alta', 'critica') DEFAULT 'sin_asignar',
    estado ENUM('pendiente', 'en_proceso', 'finalizada') DEFAULT 'pendiente',
    solucion TEXT,
    fecha_reporte DATETIME NOT NULL,
    fecha_finalizacion DATETIME
);