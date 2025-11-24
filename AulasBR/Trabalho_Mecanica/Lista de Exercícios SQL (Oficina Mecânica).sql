-- Selecione todos os veículos cadastrados que são da marca "Ford".
SELECT *
FROM Veiculo
WHERE Marca = 'Ford';

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

--Identifique as Ordens de Serviço que foram executadas por um mecânicoespecífico (Douglas2) 
SELECT os.*
FROM OS os
JOIN Mecanico m ON os.Mecanico_Responsavel = m.ID_Mecanico
WHERE m.Nome_Mecanico = 'Douglas2';






