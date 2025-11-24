<?php
session_start();
include('../config/database.php');

$database = new Database();
$db = $database->getConnection();

$query = "SELECT p.*, e.Quantidade, e.Quantidade_Minima, e.Localizacao, e.ID_Estoque
          FROM Peca p 
          INNER JOIN Estoque e ON p.ID_Peca = e.ID_Peca 
          ORDER BY p.Nome";
$stmt = $db->prepare($query);
$stmt->execute();
$pecas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Estoque de Peças</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .estoque-baixo {
            background-color: #ffeaa7 !important;
        }
        .estoque-critico {
            background-color: #fab1a0 !important;
        }
        .lucro {
            color: #27ae60;
            font-weight: bold;
        }
        .prejuizo {
            color: #e74c3c;
            font-weight: bold;
        }
        .stock-indicator {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 5px;
        }
        .stock-ok { background: #27ae60; }
        .stock-low { background: #f39c12; }
        .stock-critical { background: #e74c3c; }
        .codigo-peca {
            font-family: monospace;
            background: #f8f9fa;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>📦 Estoque de Peças</h1>
            <a href="../index.php" class="btn btn-secondary">🏠 Início</a>
            <a href="cadastrar.php" class="btn btn-primary">➕ Nova Peça</a>
        </header>

        <?php
        if (isset($_SESSION['success_message'])) {
            echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
            unset($_SESSION['success_message']);
        }
        ?>

        <div class="stock-summary">
            <h3>📊 Resumo do Estoque</h3>
            <?php
            $total_pecas = count($pecas);
            $estoque_baixo = 0;
            $estoque_critico = 0;
            
            foreach ($pecas as $peca) {
                if ($peca['Quantidade'] <= 0) {
                    $estoque_critico++;
                } elseif ($peca['Quantidade'] <= $peca['Quantidade_Minima']) {
                    $estoque_baixo++;
                }
            }
            ?>
            <p>Total de peças: <strong><?php echo $total_pecas; ?></strong> | 
               Estoque baixo: <strong style="color: #f39c12;"><?php echo $estoque_baixo; ?></strong> | 
               Estoque crítico: <strong style="color: #e74c3c;"><?php echo $estoque_critico; ?></strong></p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Código</th>
                    <th>Peça</th>
                    <th>Preço Custo</th>
                    <th>Preço Venda</th>
                    <th>Lucro</th>
                    <th>Estoque</th>
                    <th>Localização</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pecas as $peca): 
                    $lucro = $peca['Preco_Venda'] - $peca['Preco_Custo'];
                    $margem = ($lucro / $peca['Preco_Custo']) * 100;
                    
                    // Determinar classe do estoque
                    $estoque_class = '';
                    $stock_indicator = '';
                    if ($peca['Quantidade'] <= 0) {
                        $estoque_class = 'estoque-critico';
                        $stock_indicator = 'stock-critical';
                    } elseif ($peca['Quantidade'] <= $peca['Quantidade_Minima']) {
                        $estoque_class = 'estoque-baixo';
                        $stock_indicator = 'stock-low';
                    } else {
                        $stock_indicator = 'stock-ok';
                    }
                ?>
                <tr class="<?php echo $estoque_class; ?>">
                    <td>
                        <span class="stock-indicator <?php echo $stock_indicator; ?>"></span>
                    </td>
                    <td>
                        <span class="codigo-peca"><?php echo $peca['ID_Peca']; ?></span>
                    </td>
                    <td>
                        <strong><?php echo $peca['Nome']; ?></strong>
                        <?php if (!empty($peca['Descricao'])): ?>
                            <br><small style="color: #666;"><?php echo $peca['Descricao']; ?></small>
                        <?php endif; ?>
                    </td>
                    <td>R$ <?php echo number_format($peca['Preco_Custo'], 2, ',', '.'); ?></td>
                    <td>R$ <?php echo number_format($peca['Preco_Venda'], 2, ',', '.'); ?></td>
                    <td class="<?php echo $lucro >= 0 ? 'lucro' : 'prejuizo'; ?>">
                        R$ <?php echo number_format($lucro, 2, ',', '.'); ?>
                        <br><small>(<?php echo number_format($margem, 1, ',', '.'); ?>%)</small>
                    </td>
                    <td>
                        <strong><?php echo $peca['Quantidade']; ?></strong>
                        <br><small>Mín: <?php echo $peca['Quantidade_Minima']; ?></small>
                    </td>
                    <td><?php echo $peca['Localizacao'] ?: '---'; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $peca['ID_Peca']; ?>" class="btn btn-warning">✏️ Editar</a>
                        <a href="excluir.php?id=<?php echo $peca['ID_Peca']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza? Esta ação não pode ser desfeita!')">🗑️ Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if (count($pecas) === 0): ?>
            <div class="alert alert-info">
                <p>Nenhuma peça cadastrada no estoque.</p>
                <a href="cadastrar.php" class="btn btn-primary">Cadastrar Primeira Peça</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>