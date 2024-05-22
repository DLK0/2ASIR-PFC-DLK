CREATE DATABASE IF NOT EXISTS pfcdlk;
USE pfcdlk;

CREATE TABLE Cuentas (
    id_Cuenta INT AUTO_INCREMENT,
    Nombre VARCHAR(50) NOT NULL,
    Passwd VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    CONSTRAINT PK_Cuentas PRIMARY KEY (id_Cuenta)
);

CREATE TABLE Juegos (
    id_Juego INT AUTO_INCREMENT,
    Nombre_Juego VARCHAR(100) NOT NULL,
    Desarrollador VARCHAR(100) NOT NULL,
    CONSTRAINT PK_Juegos PRIMARY KEY (id_Juego)
);

CREATE TABLE Biblioteca (
    id_Cuenta INT,
    id_Juego INT,
    CONSTRAINT PK_Biblioteca PRIMARY KEY (id_Cuenta, id_Juego),
    CONSTRAINT FK_Biblioteca_Cuentas FOREIGN KEY (id_Cuenta) REFERENCES Cuentas(id_Cuenta) ON DELETE CASCADE,
    CONSTRAINT FK_Biblioteca_Juegos FOREIGN KEY (id_Juego) REFERENCES Juegos(id_Juego) ON DELETE CASCADE
);