CREATE DATABASE IF NOT EXISTS AgendaDB; 

USE AgendaDB;

CREATE TABLE IF NOT EXISTS Entradas(
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Fecha DATETIME NOT NULL,
    Titulo VARCHAR(50) NOT NULL,
    Descripcion VARCHAR(500) NULL
);