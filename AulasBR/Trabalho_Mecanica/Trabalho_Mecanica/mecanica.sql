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

-- Adicionar cliente e veículo na OS
ALTER TABLE OS 
ADD COLUMN ID_Cliente INT,
ADD COLUMN ID_Veiculo INT,
ADD FOREIGN KEY (ID_Cliente) REFERENCES Cliente(ID_Cliente),
ADD FOREIGN KEY (ID_Veiculo) REFERENCES Veiculo(ID_Veiculo);

DESCRIBE OS;

ALTER TABLE OS 
ADD COLUMN ID_Cliente INT,
ADD COLUMN ID_Veiculo INT;

ALTER TABLE OS 
ADD FOREIGN KEY (ID_Cliente) REFERENCES Cliente(ID_Cliente),
ADD FOREIGN KEY (ID_Veiculo) REFERENCES Veiculo(ID_Veiculo);

ALTER TABLE Veiculo 
ADD COLUMN IF NOT EXISTS Marca VARCHAR(50) AFTER Modelo;

-- Adicionar campos faltantes na tabela Peca
ALTER TABLE Peca 
ADD COLUMN Nome VARCHAR(100) AFTER ID_Peca,
ADD COLUMN Descricao TEXT AFTER Nome;

-- Adicionar campos faltantes na tabela Estoque
ALTER TABLE Estoque 
ADD COLUMN ID_Peca VARCHAR(20) AFTER ID_Estoque,
ADD COLUMN Quantidade_Minima INT DEFAULT 5 AFTER Quantidade,
ADD COLUMN Localizacao VARCHAR(50) AFTER Quantidade_Minima,
ADD FOREIGN KEY (ID_Peca) REFERENCES Peca(ID_Peca);

-- Inserir algumas peças de exemplo
INSERT INTO Peca (ID_Peca, Nome, Descricao, Preco_Custo, Preco_Venda) VALUES
('FILTRO-001', 'Filtro de Óleo', 'Filtro de óleo para motor', 15.00, 25.00),
('PAST-001', 'Pastilha de Freio', 'Pastilha de freio dianteira', 45.00, 80.00),
('VELA-001', 'Velas de Ignição', 'Jogo com 4 velas de ignição', 30.00, 55.00),
('CORR-001', 'Correia Dentada', 'Correia dentada original', 120.00, 200.00);

-- Inserir no Estoque
INSERT INTO Estoque (ID_Peca, Quantidade, Quantidade_Minima, Localizacao) VALUES
('FILTRO-001', 25, 5, 'Prateleira A1'),
('PAST-001', 12, 4, 'Prateleira B2'),
('VELA-001', 30, 8, 'Prateleira C3'),
('CORR-001', 6, 2, 'Prateleira D4');

INSERT INTO Cliente (Nome, CPF, Telefone, Email) VALUES
('Carlos Silva', '12345678901', '11987654321', 'carlos.silva@gmail.com'),
('Mariana Oliveira', '98765432100', '11999887766', 'mariana.oliveira@gmail.com'),
('João Pereira', '45678912300', '11988776655', 'joao.pereira@hotmail.com');

INSERT INTO Veiculo (Placa, Modelo, Marca, Ano) VALUES
('ABC1D23', 'Civic', 'Honda', 2018),
('FGH2I45', 'Corolla', 'Toyota', 2020),
('JKL3M67', 'Gol', 'Volkswagen', 2015);

INSERT INTO TEM (ID_Cliente, ID_Veiculo) VALUES
(1, 1),  
(2, 2),  
(3, 3);  

INSERT INTO Mecanico (Nome_Mecanico, Telefone) VALUES
('Rafael Souza', '11911112222'),
('Fernando Lima', '11922223333'),
('Diego Santos', '11933334444');

INSERT INTO Servico (Descricao, Data_Entrada, Data_Saida) VALUES
('Troca de óleo', '2025-01-10', '2025-01-10'),
('Revisão completa', '2025-01-05', '2025-01-07'),
('Troca de pastilha de freio', '2025-01-12', '2025-01-12');

INSERT INTO OS (
    Data_Abertura, Data_Encerramento, Descricao_Problema,
    Status, Mecanico_Responsavel, Pecas_Utilizadas, Valor_Total, 
    ID_Cliente, ID_Veiculo
) VALUES
('2025-01-10', '2025-01-10', 'Troca de óleo e filtro', 'Concluído', 1, 'FILTRO-001', 120.00, 1, 1),
('2025-01-05', '2025-01-07', 'Revisão geral', 'Concluído', 2, 'FILTRO-001, VELA-001', 450.00, 2, 2),
('2025-01-12', NULL, 'Freio fazendo ruído', 'Em andamento', 3, 'PAST-001', 220.00, 3, 3);

