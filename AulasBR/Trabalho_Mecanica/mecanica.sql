CREATE DATABASE Oficina;
USE Oficina;


-- Tabela Cliente

CREATE TABLE Cliente (
    ID_Cliente INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(100) NOT NULL,
    CPF VARCHAR(11),
    Telefone VARCHAR(15),
    Email VARCHAR(255)
);


-- Tabela Veiculo

CREATE TABLE Veiculo (
    ID_Veiculo INT AUTO_INCREMENT PRIMARY KEY,
    Placa VARCHAR(7) NOT NULL,
    Modelo VARCHAR(50),
    Ano YEAR NOT NULL
);


-- Tabela Mecanico

CREATE TABLE Mecanico (
    ID_Mecanico INT AUTO_INCREMENT PRIMARY KEY,
    Nome_Mecanico VARCHAR(70),
    Telefone VARCHAR(15)
);


-- Tabela Servico

CREATE TABLE Servico (
    ID_Servico INT AUTO_INCREMENT PRIMARY KEY,
    Descricao VARCHAR(100),
    Data_Entrada DATE,
    Data_Saida DATE
);


-- Tabela OS (Ordem de Serviço)

CREATE TABLE OS (
    ID_OS INT AUTO_INCREMENT PRIMARY KEY,
    Data_Abertura DATE,
    Data_Encerramento DATE,
    Descricao_Problema VARCHAR(255),
    Status VARCHAR(50),
    Mecanico_Responsavel INT,
    Pecas_Utilizadas VARCHAR(255),
    Valor_Total DECIMAL(10,2),
    FOREIGN KEY (Mecanico_Responsavel) REFERENCES Mecanico(ID_Mecanico)
);


-- Tabela Peca

CREATE TABLE Peca (
    ID_Peca VARCHAR(20) PRIMARY KEY,
    Preco_Custo DECIMAL(5,2) NOT NULL,
    Preco_Venda DECIMAL(5,2) NOT NULL
);


-- Tabela Estoque

CREATE TABLE Estoque (
    ID_Estoque INT AUTO_INCREMENT PRIMARY KEY,
    Quantidade INT(3) NOT NULL
);


-- Tabelas de Relacionamento


-- Cliente TEM Veiculo
CREATE TABLE TEM (
    ID_Cliente INT,
    ID_Veiculo INT,
    PRIMARY KEY (ID_Cliente, ID_Veiculo),
    FOREIGN KEY (ID_Cliente) REFERENCES Cliente(ID_Cliente),
    FOREIGN KEY (ID_Veiculo) REFERENCES Veiculo(ID_Veiculo)
);

-- Veiculo GERA OS
CREATE TABLE GERA (
    ID_Veiculo INT,
    ID_OS INT,
    PRIMARY KEY (ID_Veiculo, ID_OS),
    FOREIGN KEY (ID_Veiculo) REFERENCES Veiculo(ID_Veiculo),
    FOREIGN KEY (ID_OS) REFERENCES OS(ID_OS)
);

-- Mecanico ASSUME OS
CREATE TABLE ASSUME (
    ID_Mecanico INT,
    ID_OS INT,
    PRIMARY KEY (ID_Mecanico, ID_OS),
    FOREIGN KEY (ID_Mecanico) REFERENCES Mecanico(ID_Mecanico),
    FOREIGN KEY (ID_OS) REFERENCES OS(ID_OS)
);

-- Estoque CONTEM Peca
CREATE TABLE CONTEM (
    ID_Estoque INT,
    ID_Peca VARCHAR(20),
    PRIMARY KEY (ID_Estoque, ID_Peca),
    FOREIGN KEY (ID_Estoque) REFERENCES Estoque(ID_Estoque),
    FOREIGN KEY (ID_Peca) REFERENCES Peca(ID_Peca)
);

-- Servico PERTENCE à OS
CREATE TABLE PERTENCE (
    ID_Servico INT,
    ID_OS INT,
    PRIMARY KEY (ID_Servico, ID_OS),
    FOREIGN KEY (ID_Servico) REFERENCES Servico(ID_Servico),
    FOREIGN KEY (ID_OS) REFERENCES OS(ID_OS)
);

-- OS POSSUI Peca
CREATE TABLE POSSUI (
    ID_Peca VARCHAR(20),
    ID_OS INT,
    PRIMARY KEY (ID_Peca, ID_OS),
    FOREIGN KEY (ID_Peca) REFERENCES Peca(ID_Peca),
    FOREIGN KEY (ID_OS) REFERENCES OS(ID_OS)
);
