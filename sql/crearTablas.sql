CREATE TABLE asignaturas (
    idAsignatura INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100)
);

CREATE TABLE profesores (
    idProfesores INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    apellidos VARCHAR(150),
    email VARCHAR(150),
    telefono VARCHAR(20)
);

CREATE TABLE clases (
    idClases INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100)
);

CREATE TABLE imparte (
    idClases INT,
    idAsignatura INT,
    idProfesores INT,
    PRIMARY KEY (idClases, idAsignatura, idProfesores),
    FOREIGN KEY (idClases) REFERENCES clases(idClases),
    FOREIGN KEY (idAsignatura) REFERENCES asignaturas(idAsignatura),
    FOREIGN KEY (idProfesores) REFERENCES profesores(idProfesores)
);

CREATE TABLE horario (
    idHorario INT AUTO_INCREMENT PRIMARY KEY,
    dia_semana CHAR(1) CHECK (dia_semana IN ('L','M','X','J','V')),
    hora INT CHECK (hora BETWEEN 1 AND 7),
    idClases INT,
    idAsignatura INT,
    idProfesores INT,
    FOREIGN KEY (idClases) REFERENCES clases(idClases),
    FOREIGN KEY (idAsignatura) REFERENCES asignaturas(idAsignatura),
    FOREIGN KEY (idProfesores) REFERENCES profesores(idProfesores)
);