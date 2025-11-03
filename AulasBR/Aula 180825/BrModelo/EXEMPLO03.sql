-- ==============================
-- CRIAÇÃO DO BANCO DE DADOS
-- ==============================
CREATE DATABASE Exemplo03;
USE Exemplo03;

-- ==============================
-- CRIAÇÃO DA TABELA CLIENTES
-- ==============================
CREATE TABLE Clientes (
    Cod_Cliente INT AUTO_INCREMENT PRIMARY KEY, -- chave primária
    Nome_Cliente VARCHAR(100),                  -- nome do cliente
    CPF_Cliente VARCHAR(14) NOT NULL,           -- CPF obrigatório
    Endereco VARCHAR(100) NOT NULL,             -- endereço obrigatório
    Estado CHAR(2) DEFAULT 'SP',                -- estado padrão 'SP'
    Celular VARCHAR(19)                         -- celular opcional
); 

-- ==============================
-- CRIAÇÃO DA TABELA PRODUTOS
-- ==============================
CREATE TABLE Produtos (
    Cod_Produto INT AUTO_INCREMENT PRIMARY KEY, -- chave primária
    Nome_Produto VARCHAR(255) NOT NULL,         -- nome do produto
    Valor DECIMAL(7,2) NOT NULL,                -- valor até 99999,99
    Descricao VARCHAR(255) NOT NULL,            -- descrição obrigatória
    Qtde INT                                    -- quantidade em estoque
); 

-- ==============================
-- CRIAÇÃO DA TABELA FORNECEDORES
-- ==============================
CREATE TABLE Fornecedores (
    Cod_Fornecedor INT AUTO_INCREMENT PRIMARY KEY, -- chave primária
    Nome_Fornecedor VARCHAR(100),                  -- nome do fornecedor
    CNPJ VARCHAR(14) NOT NULL,                     -- CNPJ obrigatório
    Endereco VARCHAR(100) NOT NULL,                -- endereço obrigatório
    Cidade VARCHAR(100),                           -- nova coluna cidade
    Estado CHAR(2) DEFAULT 'SP'                    -- estado padrão 'SP'
);

-- ==============================
-- CRIAÇÃO DA TABELA TEM (RELACIONAMENTO)
-- ==============================
CREATE TABLE Tem (
    Cod_Tem INT AUTO_INCREMENT PRIMARY KEY,        -- chave primária
    Cod_Fornecedor INT,                            -- chave estrangeira fornecedor
    Cod_Produto INT,                               -- chave estrangeira produto
    FOREIGN KEY (Cod_Produto) REFERENCES Produtos (Cod_Produto),
    FOREIGN KEY (Cod_Fornecedor) REFERENCES Fornecedores (Cod_Fornecedor)
);

-- ==============================
-- ALTERAÇÕES NA TABELA CLIENTES
-- ==============================

-- Adiciona uma coluna Sexo
ALTER TABLE Clientes ADD Sexo CHAR(1);

-- Remove a coluna Sexo
ALTER TABLE Clientes DROP COLUMN Sexo;

-- Renomeia a tabela Clientes para Pessoa_Fisica
ALTER TABLE Clientes RENAME TO Pessoa_Fisica;

-- Renomeia a coluna CPF_Cliente para CPFP e altera o tamanho
ALTER TABLE Pessoa_Fisica CHANGE CPF_Cliente CPFP VARCHAR(18);

-- Aumenta o tamanho do campo Nome_Cliente
ALTER TABLE Pessoa_Fisica MODIFY COLUMN Nome_Cliente VARCHAR(150);

-- Altera o padrão da coluna Estado para 'MG'
ALTER TABLE Pessoa_Fisica MODIFY COLUMN Estado CHAR(2) DEFAULT 'MG';


-- ==================================================
-- EXERCÍCIOS DE FIXAÇÃO 
-- ==================================================
-- ACRESCENTAR OS CAMPOS CIDADE EM Pessoa_Fisica

ALTER TABLE Pessoa_Fisica
ADD Cidade VARCHAR(100);

-- ALTERAR O CAMPO VALOR PRODUTOS PARA O DECIMAL (7,2)

ALTER TABLE Produtos
MODIFY COLUMN Valor DECIMAL(7,2) NOT NULL;

-- ACRESCENTAR O  CAMPO CIDADE E ESTADO EM FORNECEDOR E DEFINIR O ESTADO PADRÃO 'SP' 

ALTER TABLE Fornecedores
ADD Cidade VARCHAR(100),
ADD Estado CHAR(2) DEFAULT 'SP';
 
