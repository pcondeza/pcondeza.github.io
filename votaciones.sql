CREATE DATABASE votaciones;

USE votaciones;

CREATE TABLE votaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    alias VARCHAR(50) NOT NULL,
    rut VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    region VARCHAR(50) NOT NULL,
    comuna VARCHAR(50) NOT NULL,
    candidato VARCHAR(50) NOT NULL,
    info VARCHAR(255) NOT NULL
);