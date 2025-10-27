-- ==============================
-- CRIAÇÃO DO BANCO DE DADOS
-- ==============================
CREATE DATABASE IF NOT EXISTS ReservaEquipamentos;

USE ReservaEquipamentos;

-- ==============================
-- TABELA Pessoa_Fisica (usuários)
-- ==============================
CREATE TABLE Pessoa_Fisica (
    Cod_Usuario INT AUTO_INCREMENT PRIMARY KEY,
    Nome_Usuario VARCHAR(100) NOT NULL,
    Email VARCHAR(100) UNIQUE NOT NULL,
    CPF VARCHAR(14) UNIQUE NOT NULL,
    Telefone VARCHAR(15),
    Tipo_Usuario ENUM('Aluno','Professor','Técnico') NOT NULL, -- só pode receber um desses três valores
    Data_Cadastro DATE,
    Cidade VARCHAR(100)
);

-- ==============================
-- TABELA Equipamento
-- ==============================
CREATE TABLE Equipamento (
    Cod_Equipamento INT AUTO_INCREMENT PRIMARY KEY,
    Nome_Equipamento VARCHAR(100) NOT NULL,
    Numero_Patrimonio VARCHAR(50) UNIQUE NOT NULL,
    Estado_Conservacao ENUM('Novo','Bom','Regular','Ruim') NOT NULL, -- só pode receber um desses valores
    Disponibilidade BOOLEAN DEFAULT TRUE NOT NULL,
    Fabricante VARCHAR(100),
    Descricao VARCHAR(255)
);

-- ==============================
-- TABELA Funcionario
-- ==============================
CREATE TABLE Funcionario (
    Cod_Funcionario INT AUTO_INCREMENT PRIMARY KEY,
    Nome_Funcionario VARCHAR(100) NOT NULL,
    Cargo VARCHAR(50) NOT NULL,
    Email VARCHAR(100) UNIQUE NOT NULL,
    Telefone VARCHAR(15),
    Data_Admissao DATE,
    Status ENUM('Ativo','Inativo') DEFAULT 'Ativo'
);

-- ==============================
-- TABELA Reserva
-- ==============================
CREATE TABLE Reserva (
    Cod_Reserva INT AUTO_INCREMENT PRIMARY KEY,
    Data_Reserva DATE NOT NULL,
    Hora_Inicio TIME NOT NULL,
    Hora_Fim TIME NOT NULL,
    Status ENUM('Ativa','Concluída','Cancelada') DEFAULT 'Ativa',
    Cod_Usuario INT NOT NULL,
    Cod_Funcionario INT NOT NULL,
    Observacao VARCHAR(200),
    FOREIGN KEY (Cod_Usuario) REFERENCES Pessoa_Fisica(Cod_Usuario),
    FOREIGN KEY (Cod_Funcionario) REFERENCES Funcionario(Cod_Funcionario)
);

-- ==============================
-- TABELA Reserva_Equipamento
-- ==============================
CREATE TABLE Reserva_Equipamento (
    Cod_Reserva INT NOT NULL,
    Cod_Equipamento INT NOT NULL,
    Quantidade INT DEFAULT 1,
    PRIMARY KEY (Cod_Reserva, Cod_Equipamento),
    FOREIGN KEY (Cod_Reserva) REFERENCES Reserva(Cod_Reserva),
    FOREIGN KEY (Cod_Equipamento) REFERENCES Equipamento(Cod_Equipamento)
);

-- ==============================
-- TABELA Manutencao_Equipamento
-- ==============================
CREATE TABLE Manutencao_Equipamento (
    Cod_Manutencao INT AUTO_INCREMENT PRIMARY KEY,
    Cod_Equipamento INT NOT NULL,
    Cod_Funcionario INT NOT NULL,
    Data_Manutencao DATE NOT NULL,
    Tipo_Manutencao ENUM('Preventiva','Corretiva') NOT NULL,
    Descricao VARCHAR(200),
    Responsavel VARCHAR(100) NOT NULL,
    Custo DECIMAL(8,2) DEFAULT 0.00,
    FOREIGN KEY (Cod_Equipamento) REFERENCES Equipamento(Cod_Equipamento),
    FOREIGN KEY (Cod_Funcionario) REFERENCES Funcionario(Cod_Funcionario)
);

-- ==============================
-- TABELA para teste com INSERT na aula de 20.10
-- ==============================
CREATE TABLE cliente_novo (
    NOME VARCHAR(40) NOT NULL,
    EMAIL VARCHAR(50) NOT NULL
);

ALTER TABLE cliente_novo
ADD CPF VARCHAR(14) UNIQUE NOT NULL,
ADD ENDERECO VARCHAR(50) NOT NULL,
ADD PROFISSAO VARCHAR(30) NOT NULL,
ADD DATA_NASC DATE;

SELECT * FROM cliente_novo;