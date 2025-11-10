CREATE DATABASE BibliotecaDB;
USE BibliotecaDB;

CREATE TABLE Livro (
    Codigo INT NOT NULL AUTO_INCREMENT,
    Titulo VARCHAR(50) NOT NULL,
    Autor VARCHAR(30) NOT NULL,
    PRIMARY KEY (Codigo)
);

CREATE TABLE Usuario (
    Codigo INT NOT NULL AUTO_INCREMENT,
    Nome VARCHAR(30) NOT NULL,
    Email VARCHAR(50) NOT NULL,
    PRIMARY KEY (Codigo)
);

ALTER TABLE Livro
ADD COLUMN Ano_Publicacao INT,
ADD COLUMN Genero VARCHAR(20);

ALTER TABLE Usuario
ADD COLUMN Telefone VARCHAR(15),
ADD COLUMN Data_Cadastro DATE;

-- Inserindo livros
INSERT INTO Livro (Titulo, Autor, Ano_Publicacao, Genero)
VALUES
('Dom Casmurro', 'Machado de Assis', 1899, 'Romance'),
('Triste Fim de Policarpo Quaresma', 'Lima Barreto', 1915, 'Romance'),
('Jantar secreto', 'Raphael Montes', 2016, 'Suspense');

-- Inserindo usuários
INSERT INTO Usuario (Nome, Email, Telefone, Data_Cadastro)
VALUES
('Ana Silva', 'ana@email.com', '11987654321', '2025-09-01'),
('Carlos Souza', 'carlos@email.com', '11912345678', '2025-09-02'),
('Mariana Lima', 'mariana@email.com', '11955554444', '2025-09-03');

-- Atualizar gênero de um livro
UPDATE Livro
SET Genero = 'Clássico'
WHERE Codigo = 1;

-- Atualizar telefone de um usuário
UPDATE Usuario
SET Telefone = '11999998888'
WHERE Codigo = 2;
