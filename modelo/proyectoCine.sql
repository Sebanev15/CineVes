CREATE DATABASE IF NOT EXISTS proyectoCine;
USE proyectoCine;

CREATE TABLE cliente(
    cliente_id INT(5) PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(11) NOT NULL,
    correo VARCHAR(20) NOT NULL,
    telefono VARCHAR(10) NOT NULL
);

CREATE TABLE pelicula(
    pelicula_id INT(5) PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(15) NOT NULL,
    director VARCHAR(25) NOT NULL,
    genero VARCHAR(10)
);

CREATE TABLE boleto(
    boleto_id INT(5) PRIMARY KEY AUTO_INCREMENT,
    cliente_id INT(5) NOT NULL,
    fecha_compra DATE NOT NULL,
    hora_funcion TIME,
    FOREIGN KEY (cliente_id) REFERENCES cliente(cliente_id)
);

CREATE TABLE detalle_boleto(
    detalle_id INT(5) PRIMARY KEY AUTO_INCREMENT,
    boleto_id INT(5) NOT NULL,
    pelicula_id INT(5) NOT NULL,
    sala VARCHAR(12) NOT NULL,
    FOREIGN KEY (boleto_id) REFERENCES boleto(boleto_id),
    FOREIGN KEY (pelicula_id) REFERENCES pelicula(pelicula_id)
);

INSERT INTO cliente (nombre, correo, telefono) VALUES
("Seba", "sebastian.perez@gmail.com", "0991234567"),
("Pedro", "pedro.gomez@gmail.com", "0992345678"),
("Pepe ", "pepe.martinez@gmail.com", "0993456789"),
("Juan ", "juan.lopez@gmail.com", "0994567890"),
("Juancito", "juancito.fernandez@gmail.com", "0995678901"),
("María", "maria.garcia@gmail.com", "0996789012"),
("Blanca", "blanca.rodriguez@gmail.com", "0997890123"),
("Lucía", "lucia.sanchez@gmail.com", "0998901234"),
("Santiago", "santiago.ramirez@gmail.com", "0999012345"),
("Federico", "federico.torres@gmail.com", "0990123456"),
("Pedrito", "pedrito.vazquez@gmail.com", "0991234568"),
("Jorge", "jorge.diaz@gmail.com", "0992345679"),
("Martín", "martin.suarez@gmail.com", "0993456780"),
("Martina", "martina.ruiz@gmail.com", "0994567891"),
("Agustín", "agustin.castro@gmail.com", "0995678902"),
("Alan", "alan.morales@gmail.com", "0996789013"),
("Ignacio", "ignacio.herrera@gmail.com", "0997890124"),
("Rodrigo", "rodrigo.mendoza@gmail.com", "0998901235"),
("Javier", "javier.ortiz@gmail.com", "0999012346"),
("Sofía", "sofia.flores@gmail.com", "0990123457");

 
INSERT INTO pelicula (titulo, director, genero) VALUES 
('The Shawshank Redemption', 'Frank Darabont', 'Drama'), 
('El padrino', 'Francis Ford Coppola', 'Crime'), 
('The Dark Knight', 'Christopher Nolan', 'Action'), 
('Pulp Fiction', 'Quentin Tarantino', 'Crime'), 
('The Lord of the Rings: The Return of the King', 'Peter Jackson', 'Fantasy'), 
('Forrest Gump', 'Robert Zemeckis', 'Drama'), 
('Inception', 'Christopher Nolan', 'Sci-Fi'), 
('Fight Club', 'David Fincher', 'Drama'), 
('The Matrix', 'Lana Wachowski, Lilly Wachowski', 'Sci-Fi'), 
('Goodfellas', 'Martin Scorsese', 'Crime'), 
('The Empire Strikes Back', 'Irvin Kershner', 'Sci-Fi'),
('The Silence of the Lambs', 'Jonathan Demme', 'Thriller'), 
('Saving Private Ryan', 'Steven Spielberg', 'War'), 
('Schindlers List', 'Steven Spielberg', 'Biography'), 
('The Green Mile', 'Frank Darabont', 'Crime'), 
('Interstellar', 'Christopher Nolan', 'Adventure'), 
('Parasite', 'Bong Joon Ho', 'Thriller'), 
('Gladiator', 'Ridley Scott', 'Action'), 
('The Lion King', 'Roger Allers, Rob Minkoff', 'Animation'), 
('The Prestige', 'Christopher Nolan', 'Drama');

INSERT INTO detalle_boleto (boleto_id, pelicula_id, sala) VALUES
(1, 1, "Sala 1"),
(2, 1, "Sala 2"),
(3, 1, "Sala 3"),
(4, 2, "Sala 4"),
(5, 4, "Sala 5"),
(6, 4, "Sala 6"),
(7, 4, "Sala 7"),
(8, 4, "Sala 8"),
(9, 5, "Sala 9"),
(10, 5, "Sala 10"),
(11, 5, "Sala 11"),
(12, 7, "Sala 12"),
(13, 7, "Sala 13"),
(14, 7, "Sala 14"),
(15, 7, "Sala 15"),
(16, 7, "Sala 16"),
(17, 17, "Sala 17"),
(18, 18, "Sala 18"),
(19, 19, "Sala 19"),
(20, 20, "Sala 20");

