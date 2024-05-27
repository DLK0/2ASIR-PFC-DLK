CREATE DATABASE IF NOT EXISTS pfcdlk;
USE pfcdlk;

CREATE TABLE Cuentas (
    id_Cuenta INT AUTO_INCREMENT,
    Nombre VARCHAR(50) NOT NULL,
    Passwd VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    CONSTRAINT PK_Cuentas PRIMARY KEY (id_Cuenta)
);

INSERT INTO Cuentas (Nombre, Passwd, Email) VALUES('Cuenta1', '12345', 'Cuenta1@asirloayza.net');

CREATE TABLE Juegos (
    id_Juego INT AUTO_INCREMENT,
    Nombre_Juego VARCHAR(100) NOT NULL,
    Desarrollador VARCHAR(100) NOT NULL,
    CONSTRAINT PK_Juegos PRIMARY KEY (id_Juego)
);

INSERT INTO Juegos (Nombre_Juego, Desarrollador) VALUES('Cyberpunk 2077', 'CD Projekt Red');
INSERT INTO Juegos (Nombre_Juego, Desarrollador) VALUES('The Witcher III', 'CD Projekt Red');
INSERT INTO Juegos (Nombre_Juego, Desarrollador) VALUES('Black Desert', 'Pearl Abyss');
INSERT INTO Juegos (Nombre_Juego, Desarrollador) VALUES('Resident Evil 2', 'Capcom');
INSERT INTO Juegos (Nombre_Juego, Desarrollador) VALUES('Monster Hunter World', 'Capcom');
INSERT INTO Juegos (Nombre_Juego, Desarrollador) VALUES('Warframe', 'Digital Extremes');
INSERT INTO Juegos (Nombre_Juego, Desarrollador) VALUES('Rainbow Six Siege', 'Ubisoft');
INSERT INTO Juegos (Nombre_Juego, Desarrollador) VALUES('Counter Strike 2', 'Valve');


CREATE TABLE Biblioteca (
    id_Cuenta INT,
    id_Juego INT,
    CONSTRAINT PK_Biblioteca PRIMARY KEY (id_Cuenta, id_Juego),
    CONSTRAINT FK_Biblioteca_Cuentas FOREIGN KEY (id_Cuenta) REFERENCES Cuentas(id_Cuenta) ON DELETE CASCADE,
    CONSTRAINT FK_Biblioteca_Juegos FOREIGN KEY (id_Juego) REFERENCES Juegos(id_Juego) ON DELETE CASCADE
);

INSERT INTO Biblioteca (id_Cuenta, id_Juego) VALUES(1, 3);
INSERT INTO Biblioteca (id_Cuenta, id_Juego) VALUES(1, 5);
INSERT INTO Biblioteca (id_Cuenta, id_Juego) VALUES(1, 7);