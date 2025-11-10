CREATE DATABASE Livraria;
USE Livraria;

-- Tabela Autores
CREATE TABLE Autores (
    ID_autor INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    nacionalidade VARCHAR(150),
    data_nasc_autor DATE
);

-- Tabela Editoras
CREATE TABLE Editoras (
    ID_editora INT AUTO_INCREMENT PRIMARY KEY,
    nome_editora VARCHAR(150) NOT NULL,
    endereco VARCHAR(150),
    contato VARCHAR(150),
    telefone VARCHAR(20),
    cidade VARCHAR(150),
    cnpj VARCHAR(20) UNIQUE
);

-- Tabela Clientes
CREATE TABLE Clientes (
    ID_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nome_cliente VARCHAR(150) NOT NULL,
    cpf VARCHAR(25) UNIQUE NOT NULL,
    email VARCHAR(150),
    telefone VARCHAR(20),
    data_nasc_cliente DATE
);

-- Tabela Livros
CREATE TABLE Livros (
    ID_livro INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    genero VARCHAR(150),
    preco DECIMAL(10,2) NOT NULL,
    quantidade INT DEFAULT 0,
    ID_autor INT,    
    ID_editora INT,
    FOREIGN KEY (ID_autor) REFERENCES Autores(ID_autor),
    FOREIGN KEY (ID_editora) REFERENCES Editoras(ID_editora)
);

-- Tabela Vendas (aqui cada venda está ligada a 1 cliente e 1 livro)
CREATE TABLE Vendas (
    ID_venda INT AUTO_INCREMENT PRIMARY KEY,
    data_venda DATE NOT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    ID_cliente INT,
    ID_livro INT,
    FOREIGN KEY (ID_cliente) REFERENCES Clientes(ID_cliente),
    FOREIGN KEY (ID_livro) REFERENCES Livros(ID_livro)
);



------ Insert ------
-- Autores
INSERT INTO Autores (nome, nacionalidade, data_nasc_autor)
VALUES
('J. K. Rowling', 'Britânica', '1965-07-31'),
('George R. R. Martin', 'Americano', '1948-09-20'),
('Machado de Assis', 'Brasileiro', '1839-06-21');

-- Editoras
INSERT INTO Editoras (nome_editora, endereco, contato, telefone, cidade, cnpj)
VALUES
('Rocco', 'Rua das Letras, 123', 'Ana Souza', '21999990000', 'Rio de Janeiro', '12.345.678/0001-99'),
('Leya', 'Av. Paulista, 500', 'Carlos Silva', '1133334444', 'São Paulo', '98.765.432/0001-11'),
('Companhia das Letras', 'Rua Augusta, 2500', 'Fernanda Lima', '1132323232', 'São Paulo', '11.222.333/0001-44');

-- Clientes
INSERT INTO Clientes (nome_cliente, cpf, email, telefone, data_nasc_cliente)
VALUES
('Maria Silva', '123.456.789-00', 'maria@email.com', '21988887777', '1990-05-12'),
('João Pereira', '987.654.321-00', 'joao@email.com', '21911112222', '1985-11-03'),
('Ana Costa', '456.789.123-55', 'ana@email.com', '11955554444', '2000-02-28');

-- Livros
INSERT INTO Livros (titulo, genero, preco, quantidade, ID_autor, ID_editora)
VALUES
('Harry Potter e a Pedra Filosofal', 'Fantasia', 59.90, 100, 1, 1),
('Harry Potter e a Câmara Secreta', 'Fantasia', 65.00, 80, 1, 1),
('A Guerra dos Tronos', 'Fantasia', 89.90, 50, 2, 2),
('Dom Casmurro', 'Romance', 39.90, 60, 3, 3);

-- Vendas (1 cliente comprando 1 livro por vez)
INSERT INTO Vendas (data_venda, valor_total, ID_cliente, ID_livro)
VALUES
('2025-09-20', 59.90, 1, 1), -- Maria comprou Harry Potter 1
('2025-09-21', 89.90, 2, 3), -- João comprou A Guerra dos Tronos
('2025-09-22', 39.90, 3, 4); -- Ana comprou Dom Casmurro

-- CONSULTA * TODOS OS DADOS
SELECT * FROM AUTORES, LIVROS;
SELECT * FROM LIVROS;

-- CONSULTA POR CAMPOES
SELECT TITULO FROM LIVROS;
SELECT TITULO, ANO_PUBLICAÇAO FROM LIVROS;

-- CONSULTA POR DATA COM CONDIÇAO
SELECT TITULO, AUTOR FROM LIVROS
WHERE ANO_PUBLICAÇAO > 2015;

-- CONSULTA POR CRECENTE E DECRECENTE
SELECT TITULO, ANO_PUBLICAÇAO FROM LIVROS
order by ANO_PUBLICAÇAO DESC;

-- CONSULTA POR LIMITE DE RESULTADO
SELECT TITULO FROM LIVROS
LIMIT 5;

-- RENOMEAR COLUNAS COM AS
SELECT TITULO AS NOME, AUTOR AS ESCRITOR
FROM LIVROS;

-- FUNÇOES  AGREGADAS
SELECT count(*) AS TOTAL_LIVROS
FROM LIVROS;

SELECT SUM(PRECO) AS  TOTAL_LIVROS
FROM LIVROS;

SELECT AVG(PRECO) AS TOTAL_LIVROS
FROM LIVROS;

-- AGRUPAMENTOS COM GROUP BY
SELECT AUTOR, count(*) AS QUANTIDADE
FROM LIVROS
group by AUTOR;

-- USO DE AND OU OR
SELECT TITULO, PRECO FROM LIVROS
WHERE TITULO = "HARRY" AND PRECO > 30;

SELECT TITULO, PRECO  FROM LIVROS
WHERE TITULO = "HARRY" OR PRECO > 30;

-- CONDIÇAO EXTRAS COM GROUP BY, HAVING E ORDER BY

SELECT ID_LIVROS, COUNT(*) AS TOTAL_LIVROS
FROM LIVROS
GROUP BY ID_AUTOR
HAVING TOTAL_LIVROS > 5
ORDER BY TOTAL_LIVROS DESC;

-- USO DO LIKE
SELECT TITULO FROM LIVROS
WHERE TITULO LIKE '%HARRY%';

-- USO DO LIKE COM INICIO POR LETRAS
SELECT TITULO FROM LIVROS
WHERE TITULO LIKE 'H%';

-- USO DO LIKE COM TERMINO POR LETRAS 
SELECT TITULO FROM LIVROS
WHERE TITULO LIKE '%RY';

-- USO DO LIKE POR QUANTIDADE DE LETRAS 
SELECT TITULO FROM LIVROS
WHERE TITULO LIKE 'H___Y';

-- COMBINANDO SITUAÇÕES
SELECT TITULO, PRECO FROM LIVROS
WHERE TITULO LIKE '%HARRY%'
ORDER BY PRECO DESC;

-- Adicionar campos na tabela Autores

ALTER TABLE Autores
ADD biografia TEXT,
ADD email VARCHAR(150),
ADD site_oficial VARCHAR(200),
ADD premios TEXT,
ADD data_falecimento DATE;

-- Apagando campos na tabela Autores

ALTER TABLE Autores
DROP biografia;

ALTER TABLE Autores
DROP email,
DROP site_oficial,
DROP premios,
DROP data_falecimento;

-- Inserindo os autores

INSERT INTO Autores (nome, nacionalidade, data_nasc_autor)
VALUES
('Lima Barreto', 'Brasileiro', '1881-05-13'),
('Clarice Lispector', 'Brasileira', '1920-12-10'),
('Jones Manoel', 'Brasileiro', '1990-01-01'),
('Ailton Krenak', 'Brasileiro', '1953-09-29'),
('Caio Fernando Abreu', 'Brasileiro', '1948-09-12');

-- Inserindo os livros

INSERT INTO Livros (titulo, genero, preco, quantidade, ID_autor, ID_editora)
VALUES
('Triste Fim de Policarpo Quaresma', 'Romance', 45.90, 40, 4, 3),
('A Hora da Estrela', 'Romance', 39.90, 50, 5, 3),
('História e Luta de Classes', 'Política', 55.00, 30, 6, 2),
('Ideias para Adiar o Fim do Mundo', 'Ensaios', 42.00, 60, 7, 3),
('Morangos Mofados', 'Contos', 44.90, 35, 8, 3);

-- inserindo editoras

INSERT INTO Editoras (nome_editora, endereco, contato, telefone, cidade, cnpj)
VALUES
('Editora Brasiliense', 'Rua da Liberdade, 100', 'Paulo Andrade', '1133335555', 'São Paulo', '22.111.333/0001-55'),
('Editora Record', 'Av. Atlântica, 450', 'Mariana Lopes', '2122224444', 'Rio de Janeiro', '33.444.555/0001-22'),
('Editora Moderna', 'Rua XV de Novembro, 250', 'Ricardo Santos', '1134445566', 'São Paulo', '44.555.666/0001-33'),
('Editora Vozes', 'Rua da Paz, 77', 'Sônia Castro', '2432323232', 'Petrópolis', '55.666.777/0001-44'),
('Editora Objetiva', 'Av. Brasil, 800', 'Fernanda Rocha', '2132324545', 'Rio de Janeiro', '66.777.888/0001-55');

-- Inserindo novos Clientes

INSERT INTO Clientes (nome_cliente, cpf, email, telefone, data_nasc_cliente)
VALUES
('Pedro Almeida', '111.222.333-44', 'pedro@email.com', '21988884444', '1992-08-15'),
('Carla Mendes', '555.666.777-88', 'carla@email.com', '11999998888', '1988-03-22'),
('Lucas Ferreira', '999.888.777-66', 'lucas@email.com', '21911113333', '2001-07-30'),
('Beatriz Oliveira', '444.333.222-11', 'bia@email.com', '31922224444', '1995-12-05'),
('Rafael Santos', '222.333.444-55', 'rafael@email.com', '21955556666', '1982-10-10');

-- Inserindo novas Vendas

INSERT INTO Vendas (data_venda, valor_total, ID_cliente, ID_livro)
VALUES
('2025-09-25', 45.90, 4, 5), -- Pedro comprou Triste Fim de Policarpo Quaresma
('2025-09-25', 39.90, 5, 6), -- Carla comprou A Hora da Estrela
('2025-09-26', 55.00, 6, 7), -- Lucas comprou História e Luta de Classes
('2025-09-26', 42.00, 7, 8), -- Beatriz comprou Ideias para Adiar o Fim do Mundo
('2025-09-27', 44.90, 8, 9); -- Rafael comprou Morangos Mofados

-- total livros

SELECT COUNT(*) AS total_vendas
FROM Livros;

-- Livro com letra A e preço acima de 100

SELECT titulo, preco
FROM Livros
WHERE titulo LIKE 'A%' 
  AND preco > 100;

-- soma dos livros vendidos

SELECT COUNT(*) AS total_livros_vendidos
FROM Vendas;

-- apagando o livro com codigo 5

DELETE FROM Vendas WHERE ID_livro = 5; -- Primeiro apagar as vendas relacionadas:

DELETE FROM Livros WHERE ID_livro = 5; -- Depois apagar o livro:

-- Adicionando a coluna ano de publicação na tabela livros

ALTER TABLE Livros
ADD COLUMN ano_publicacao DATE;

