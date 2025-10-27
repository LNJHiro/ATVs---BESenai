CREATE DATABASE IF NOT EXISTS PraticaDiscos;

USE PraticaDiscos;

-- Apenas uma tabela para começar
CREATE TABLE discos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    artista VARCHAR(150) NOT NULL,
    ano_lancamento INT,
    genero VARCHAR(100)
);

SELECT * FROM discos;