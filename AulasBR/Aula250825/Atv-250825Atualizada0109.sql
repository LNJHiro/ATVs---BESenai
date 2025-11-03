-- ==================================
-- CRIAÇÃO DO BANCO DE DADOS
-- ==================================
CREATE DATABASE ProjetoInstituicao;

USE ProjetoInstituicao;

-- ==================================
-- TABELA FORNECEDOR
-- ==================================
CREATE TABLE Fornecedor (
    Fcodigo INT AUTO_INCREMENT PRIMARY KEY,
    Fnome VARCHAR(100) NOT NULL,
    Status VARCHAR(20) DEFAULT 'Ativo',
    Cidade VARCHAR(100)
);

-- ==================================
-- TABELA PECA
-- ==================================
CREATE TABLE Peca (
    Pcodigo INT AUTO_INCREMENT PRIMARY KEY,
    Pnome VARCHAR(100) NOT NULL,
    Cor VARCHAR(50) NOT NULL,
    Peso INT NOT NULL,
    Cidade VARCHAR(100) NOT NULL
);

-- ==================================
-- TABELA INSTITUICAO
-- ==================================
CREATE TABLE Instituicao (
    Icodigo INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(100) NOT NULL
);

-- ==================================
-- TABELA PROJETO
-- ==================================
CREATE TABLE Projeto (
    PRcodigo INT AUTO_INCREMENT PRIMARY KEY,
    PRnome VARCHAR(100) NOT NULL,
    Cidade VARCHAR(100) NOT NULL,
    Icodigo INT,
    FOREIGN KEY (Icodigo) REFERENCES Instituicao(Icodigo)
);

-- ==================================
-- TABELA RELAÇÃO_1 (Fornecedor <-> Projeto)
-- ==================================
CREATE TABLE Relacao_1 (
    Pcodigo INT NOT NULL,
    Fcodigo INT NOT NULL,
    PRIMARY KEY (Pcodigo, Fcodigo),
    FOREIGN KEY (Pcodigo) REFERENCES Peca(Pcodigo),
    FOREIGN KEY (Fcodigo) REFERENCES Fornecedor(Fcodigo)
);

-- ==================================
-- TABELA FORNECE
-- ==================================
CREATE TABLE Fornece (
    Codigo INT AUTO_INCREMENT PRIMARY KEY,
    Fcod INT,
    PRcod INT,
    Pcod INT,
    FOREIGN KEY (Fcod) REFERENCES Fornecedor(Fcodigo),
    FOREIGN KEY (PRcod) REFERENCES Projeto(PRcodigo),
    FOREIGN KEY (Pcod) REFERENCES Peca(Pcodigo)
);

-- ==================================
-- TABELA FORNECIMENTO
-- ==================================
CREATE TABLE Fornecimento (
    Codigo INT AUTO_INCREMENT PRIMARY KEY,
    Fcod INT,
    PRcod INT,
    Pcod INT,
    Quantidade VARCHAR(50),
    FOREIGN KEY (Fcod) REFERENCES Fornecedor(Fcodigo),
    FOREIGN KEY (PRcod) REFERENCES Projeto(PRcodigo),
    FOREIGN KEY (Pcod) REFERENCES Peca(Pcodigo)
);

-- ==================================
-- TABELA É FORNECIDA
-- ==================================
CREATE TABLE Efornecida (
    Codigo INT AUTO_INCREMENT PRIMARY KEY,
    Fcod INT,
    PRcod INT,
    Pcod INT,
    Pcodigo INT NOT NULL,
    FOREIGN KEY (Fcod) REFERENCES Fornecedor(Fcodigo),
    FOREIGN KEY (PRcod) REFERENCES Projeto(PRcodigo),
    FOREIGN KEY (Pcod) REFERENCES Peca(Pcodigo),
    FOREIGN KEY (Pcodigo) REFERENCES Peca(Pcodigo)
);

-- ==================================
-- TABELA MANTEM
-- ==================================
CREATE TABLE Mantem (
    Codigo INT AUTO_INCREMENT PRIMARY KEY,
    Icod INT,
    PRcod INT,
    Icodigo INT,
    FOREIGN KEY (Icod) REFERENCES Instituicao(Icodigo),
    FOREIGN KEY (PRcod) REFERENCES Projeto(PRcodigo)
);       

ALTER TABLE Mantem DROP FOREIGN KEY mantem_ibfk_1;

-- ==================================
-- TABELA RECEBE
-- ==================================
CREATE TABLE Recebe (
    Codigo INT AUTO_INCREMENT PRIMARY KEY,
    Fcod INT,
    PRcod INT,
    Pcod INT,
    Icod INT,
    Icodigo INT,
    FOREIGN KEY (Fcod) REFERENCES Fornecedor(Fcodigo),
    FOREIGN KEY (PRcod) REFERENCES Projeto(PRcodigo),
    FOREIGN KEY (Pcod) REFERENCES Peca(Pcodigo),
    FOREIGN KEY (Icod) REFERENCES Instituicao(Icodigo)
);
-- ==============================
-- ALTERAÇÕES NAS TABELAS
-- ==============================

--  Remover a tabela Instituicao (não existe mais no novo modelo)
DROP TABLE Instituicao;

--  Cria a nova tabela Cidade
CREATE TABLE Cidade (
    Ccod INT AUTO_INCREMENT PRIMARY KEY,
    Cnome VARCHAR(100) NOT NULL,
    UF CHAR(2) NOT NULL
);

--  Altera tabela Fornecedor
ALTER TABLE Fornecedor
    ADD COLUMN Fone VARCHAR(20),        -- adiciona telefone
    ADD COLUMN Ccod INT,                -- adiciona chave estrangeira para Cidade
    ADD CONSTRAINT fk_fornecedor_cidade FOREIGN KEY (Ccod) REFERENCES Cidade(Ccod);

--  Altera tabela Peca
ALTER TABLE Peca
    ADD COLUMN Ccod INT,  -- adiciona chave estrangeira para Cidade
    ADD CONSTRAINT fk_peca_cidade FOREIGN KEY (Ccod) REFERENCES Cidade(Ccod);

--  Altera tabela Projeto
-- se já existir, só adiciona o campo da cidade
ALTER TABLE Projeto
    ADD COLUMN Ccod INT,  -- adiciona chave estrangeira para Cidade
    ADD CONSTRAINT fk_projeto_cidade FOREIGN KEY (Ccod) REFERENCES Cidade(Ccod);

-- Ajusta a tabela Fornecimento
-- Primeiro apagar a antiga, para recriar de forma certa
DROP TABLE IF EXISTS Fornecimento;

CREATE TABLE Fornecimento (
    Fcod INT,
    Pcod INT,
    PRcod INT,
    Quantidade INT NOT NULL,
    PRIMARY KEY (Fcod, Pcod, PRcod),
    FOREIGN KEY (Fcod) REFERENCES Fornecedor(Fcod),
    FOREIGN KEY (Pcod) REFERENCES Peca(Pcod),
    FOREIGN KEY (PRcod) REFERENCES Projeto(PRcod)
);

-- ==============================
-- ÍNDICES PARA CONSULTAS RÁPIDAS
-- ==============================

-- Índice para agilizar busca por fornecedor pelo nome
CREATE INDEX idx_fornecedor_nome ON Fornecedor(Fnome);

-- Índice para busca por peça pelo nome
CREATE INDEX idx_peca_nome ON Peca(Pnome);

-- Índice para busca por projetos pelo nome
CREATE INDEX idx_projeto_nome ON Projeto(PRnome);

