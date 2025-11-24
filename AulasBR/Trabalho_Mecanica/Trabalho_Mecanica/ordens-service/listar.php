<?php
session_start();
include('../config/database.php');

$database = new Database();
$db = $database->getConnection();

$query = "SELECT OS.*, 
                 Cliente.Nome as Nome_Cliente,
                 Mecanico.Nome_Mecanico,
                 Veiculo.Marca as Marca_Veiculo,
                 Veiculo.Modelo as Modelo_Veiculo,
                 Veiculo.Placa as Placa_Veiculo,
                 Veiculo.Ano as Ano_Veiculo
          FROM OS 
          LEFT JOIN Cliente ON OS.ID_Cliente = Cliente.ID_Cliente
          LEFT JOIN Mecanico ON OS.Mecanico_Responsavel = Mecanico.ID_Mecanico
          LEFT JOIN Veiculo ON OS.ID_Veiculo = Veiculo.ID_Veiculo
          ORDER BY OS.ID_OS DESC";
          
$stmt = $db->prepare($query);
$stmt->execute();
$ordens = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Ordens de Serviço</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>📋 Ordens de Serviço</h1>
            <a href="../index.php" class="btn btn-secondary">🏠 Início</a>
            <a href="cadastrar.php" class="btn btn-primary">➕ Nova OS</a>
        </header>

        <?php
        if (isset($_SESSION['success_message'])) {
            echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
            unset($_SESSION['success_message']);
        }
        ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Veículo</th>
                    <th>Data</th>
                    <th>Mecânico</th>
                    <th>Status</th>
                    <th>Valor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ordens as $os): ?>
                <tr>
                    <td><?php echo $os['ID_OS']; ?></td>
                    <td><?php echo $os['Nome_Cliente'] ?? 'N/A'; ?></td>
                    <td>
                        <?php 
                        $marca = $os['Marca_Veiculo'] ?? '';
                        $modelo = $os['Modelo_Veiculo'] ?? 'N/A';
                        $placa = $os['Placa_Veiculo'] ?? '';
                        $ano = $os['Ano_Veiculo'] ?? '';
                        
                        if (!empty($marca)) {
                            echo '<strong>' . $marca . ' ' . $modelo . '</strong>';
                        } else {
                            echo '<strong>' . $modelo . '</strong>';
                        }
                        
                        if (!empty($placa)) {
                            echo '<br><small>Placa: ' . $placa . '</small>';
                        }
                        
                        if (!empty($ano)) {
                            echo '<br><small>Ano: ' . $ano . '</small>';
                        }
                        ?>
                    </td>
                    <td><?php echo date('d/m/Y', strtotime($os['Data_Abertura'])); ?></td>
                    <td><?php echo $os['Nome_Mecanico'] ?? 'N/A'; ?></td>
                    <td>
                        <span style="padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; 
                            background: <?php 
                                switch($os['Status']) {
                                    case 'Aberto': echo '#3498db; color: white'; break;
                                    case 'Em Andamento': echo '#f39c12; color: white'; break;
                                    case 'Aguardando Peças': echo '#e74c3c; color: white'; break;
                                    case 'Concluído': echo '#27ae60; color: white'; break;
                                    case 'Entregue': echo '#95a5a6; color: white'; break;
                                    default: echo '#bdc3c7; color: black'; break;
                                }
                            ?>">
                            <?php echo $os['Status']; ?>
                        </span>
                    </td>
                    <td>R$ <?php echo number_format($os['Valor_Total'], 2, ',', '.'); ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $os['ID_OS']; ?>" class="btn btn-warning">✏️ Editar</a>
                        <a href="excluir.php?id=<?php echo $os['ID_OS']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza?')">🗑️ Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>