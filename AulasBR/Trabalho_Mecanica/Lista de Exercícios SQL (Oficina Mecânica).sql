--SELECTS

-- Selecione todos os veículos cadastrados que são da marca "Ford".
SELECT *
FROM Veiculo
WHERE Marca = 'Volkswagen';

-- Liste todos as OS que ultrapassaram os 200 reais 
SELECT *
FROM OS
WHERE Valor_Total > 200;

-- Mostre os mecânicos que possuem o status concluido
SELECT DISTINCT 
    m.ID_Mecanico,
    m.Nome_Mecanico,
    m.Telefone
FROM Mecanico m
JOIN OS os ON os.Mecanico_Responsavel = m.ID_Mecanico
WHERE os.Status = 'Concluído';

-- Exiba todas as Ordens de Serviço (OS) que estão com o status "Aguardando Peça".
SELECT *
FROM OS
WHERE Status = 'Aguardando Peças';

-- consulta para encontrar os veículos que já tiveram mais de uma Ordem de Serviço (retornaram à oficina) usando uma subconsulta correlacionada.
SELECT *
FROM Veiculo v
WHERE (
    SELECT COUNT(*)
    FROM OS o
    WHERE o.ID_Veiculo = v.ID_Veiculo
) > 1;

--Identifique as Ordens de Serviço que foram executadas por um mecânicoespecífico (Diego Santos) 
SELECT os.*
FROM OS os
JOIN Mecanico m ON os.Mecanico_Responsavel = m.ID_Mecanico
WHERE m.Nome_Mecanico = 'Diego Santos';

-- Selecione todos os veículos cadastrados que são da marca "Ford".

SELECT *
FROM Veiculo
WHERE Marca = 'Volkswagen';

--UPDATES

-- Atualizar o preço de venda da peça "FILTRO-001" com aumento de 5%
UPDATE Peca 
SET Preco_Venda = ROUND(Preco_Venda * 1.05, 2)
WHERE ID_Peca = 'FILTRO-001';

-- Modifique o status da Ordem de Serviço de ID 105 de "Em Execução" para "Concluída".
UPDATE OS SET Status = 'Concluído' WHERE ID_OS = 3;

--ALTER TABLE 

-- adicionar nova coluna
ALTER TABLE Mecanico 
MODIFY COLUMN Telefone VARCHAR(20);

ALTER TABLE Veiculo 
ADD COLUMN Ativo BOOLEAN DEFAULT TRUE;

-- INNER JOIN

-- Liste todas as Ordens de Serviço com cliente, placa e data

SELECT 
    os.ID_OS,
    c.Nome as Cliente,
    v.Placa as Placa_Veiculo,
    os.Data_Abertura,
    os.Status,
    os.Valor_Total
FROM OS os
JOIN Cliente c ON os.ID_Cliente = c.ID_Cliente
JOIN Veiculo v ON os.ID_Veiculo = v.ID_Veiculo
ORDER BY os.Data_Abertura DESC;

--LEFT JOIN

-- Clientes com ou sem OS

SELECT 
    c.Nome as Cliente,
    c.Telefone,
    c.Email,
    IFNULL(GROUP_CONCAT(os.ID_OS), 'Nenhuma OS') as Ordens_de_Servico
FROM Cliente c
LEFT JOIN OS os ON c.ID_Cliente = os.ID_Cliente
GROUP BY c.ID_Cliente, c.Nome, c.Telefone, c.Email
ORDER BY c.Nome;

-- RIGHT JOIN

-- Todas as Ordens de Serviço e nome do cliente

SELECT 
    os.ID_OS,
    os.Data_Abertura,
    os.Status,
    os.Valor_Total,
    c.Nome as Cliente
FROM Cliente c
RIGHT JOIN OS os ON c.ID_Cliente = os.ID_Cliente
ORDER BY os.Data_Abertura DESC;

-- Veículos sem OS

SELECT 
    'COM OS' as Status,
    COUNT(DISTINCT v.ID_Veiculo) as Total_Veiculos,
    GROUP_CONCAT(DISTINCT v.Placa ORDER BY v.Placa) as Placas
FROM Veiculo v
INNER JOIN OS os ON v.ID_Veiculo = os.ID_Veiculo

UNION ALL

SELECT 
    'SEM OS' as Status,
    COUNT(DISTINCT v.ID_Veiculo) as Total_Veiculos,
    GROUP_CONCAT(DISTINCT v.Placa ORDER BY v.Placa) as Placas
FROM Veiculo v
WHERE NOT EXISTS (
    SELECT 1 
    FROM OS os 
    WHERE os.ID_Veiculo = v.ID_Veiculo
);

-- Faturamento total de uma OS específica (ex: ID 1)

SELECT 
    ID_OS,
    Data_Abertura,
    Descricao_Problema,
    Status,
    Valor_Total as Faturamento_Total
FROM OS
WHERE ID_OS = 1;

-- 9.1 AGREGAÇÕES SIMPLES
-- 1. Número total de veículos cadastrados
SELECT 
    '1. Total Veículos' as Exercicio,
    COUNT(*) as Resultado
FROM Veiculo;

-- 2. Valor total do inventário
SELECT 
    '2. Valor Total Estoque (Custo)' as Exercicio,
    CONCAT('R$ ', FORMAT(SUM(e.Quantidade * p.Preco_Custo), 2)) as Resultado
FROM Estoque e
INNER JOIN Peca p ON e.ID_Peca = p.ID_Peca;

-- 3. Preço médio da mão de obra
SELECT 
    '3. Mão de Obra Média' as Exercicio,
    CONCAT('R$ ', FORMAT(
        AVG(
            os.Valor_Total - COALESCE((
                SELECT SUM(p.Preco_Venda * ps.Quantidade)
                FROM POSSUI ps
                INNER JOIN Peca p ON ps.ID_Peca = p.ID_Peca
                WHERE ps.ID_OS = os.ID_OS
            ), 0)
        ), 2
    )) as Resultado
FROM OS os
WHERE os.Valor_Total > 0;

-- AGREGAÇÕES COM GROUP BY
--  Veículos por marca
SELECT 
    'Veículos por Marca' as Exercicio,
    Marca,
    COUNT(*) as Total
FROM Veiculo
WHERE Marca IS NOT NULL
GROUP BY Marca
ORDER BY Total DESC;

--  OS por mês
SELECT 
    'OS por Mês' as Exercicio,
    DATE_FORMAT(Data_Abertura, '%Y-%m') as Mes,
    COUNT(*) as Total_OS
FROM OS
WHERE Data_Abertura IS NOT NULL
GROUP BY DATE_FORMAT(Data_Abertura, '%Y-%m')
ORDER BY Mes DESC;

-- OS por status
SELECT 
    ' OS por Status' as Exercicio,
    Status,
    COUNT(*) as Total
FROM OS
WHERE Status IS NOT NULL
GROUP BY Status
ORDER BY Total DESC;

-- AGREGAÇÕES COM WHERE
-- Total OS "Concluído"
SELECT 
    'OS Concluídas' as Exercicio,
    COUNT(*) as Total,
    CONCAT('R$ ', FORMAT(SUM(Valor_Total), 2)) as Faturamento
FROM OS
WHERE Status = 'Concluído';

-- Faturamento Toyota último ano
SELECT 
    'Faturamento Toyota (Último Ano)' as Exercicio,
    COUNT(*) as Total_OS,
    CONCAT('R$ ', FORMAT(SUM(os.Valor_Total), 2)) as Faturamento_Total
FROM OS os
INNER JOIN Veiculo v ON os.ID_Veiculo = v.ID_Veiculo
WHERE v.Marca = 'Toyota'
    AND os.Data_Abertura >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR);

