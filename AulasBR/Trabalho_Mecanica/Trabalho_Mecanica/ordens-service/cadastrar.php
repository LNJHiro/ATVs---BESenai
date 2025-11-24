<?php
session_start();
include('../config/database.php');

$database = new Database();
$db = $database->getConnection();

// Buscar clientes para o select
$queryClientes = "SELECT * FROM Cliente ORDER BY Nome";
$stmtClientes = $db->prepare($queryClientes);
$stmtClientes->execute();
$clientes = $stmtClientes->fetchAll(PDO::FETCH_ASSOC);

// Buscar mecânicos para o select
$queryMecanicos = "SELECT * FROM Mecanico ORDER BY Nome_Mecanico";
$stmtMecanicos = $db->prepare($queryMecanicos);
$stmtMecanicos->execute();
$mecanicos = $stmtMecanicos->fetchAll(PDO::FETCH_ASSOC);

// Buscar veículos para o select
$queryVeiculos = "SELECT * FROM Veiculo ORDER BY Modelo";
$stmtVeiculos = $db->prepare($queryVeiculos);
$stmtVeiculos->execute();
$veiculos = $stmtVeiculos->fetchAll(PDO::FETCH_ASSOC);

if ($_POST) {
    try {
        $query = "INSERT INTO OS SET 
                  Data_Abertura=:data_abertura, 
                  Descricao_Problema=:descricao, 
                  Status=:status, 
                  Mecanico_Responsavel=:mecanico,
                  ID_Cliente=:cliente,
                  ID_Veiculo=:veiculo,
                  Valor_Total=:valor";
        
        $stmt = $db->prepare($query);
        
        $data_abertura = $_POST['data_abertura'];
        $descricao = $_POST['descricao'];
        $status = $_POST['status'];
        $mecanico = $_POST['mecanico'];
        $cliente = $_POST['cliente'];
        $veiculo = $_POST['veiculo'];
        $valor = $_POST['valor'] ?: 0;
        
        $stmt->bindParam(":data_abertura", $data_abertura);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":mecanico", $mecanico);
        $stmt->bindParam(":cliente", $cliente);
        $stmt->bindParam(":veiculo", $veiculo);
        $stmt->bindParam(":valor", $valor);
        
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Ordem de Serviço cadastrada com sucesso!";
            header("Location: listar.php");
            exit();
        }
    } catch(PDOException $exception) {
        $_SESSION['error_message'] = "Erro ao cadastrar OS: " . $exception->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Ordem de Serviço</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .form-section {
            background: #f8f9fa;
            padding: 1.5rem;
            margin: 1rem 0;
            border-radius: 8px;
            border-left: 4px solid #3498db;
        }
        .form-section h3 {
            margin-top: 0;
            color: #2c3e50;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>📋 Cadastrar Ordem de Serviço</h1>
            <a href="listar.php" class="btn btn-secondary">⬅️ Voltar</a>
        </header>

        <?php
        if (isset($_SESSION['error_message'])) {
            echo '<div class="alert alert-error">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']);
        }
        ?>

        <form method="POST">
            <!-- Seção: Informações do Cliente -->
            <div class="form-section">
                <h3>👤 Informações do Cliente</h3>
                <div class="form-group">
                    <label for="cliente">Cliente:</label>
                    <select id="cliente" name="cliente" required>
                        <option value="">Selecione um cliente</option>
                        <?php foreach ($clientes as $cliente): ?>
                            <option value="<?php echo $cliente['ID_Cliente']; ?>">
                                <?php echo $cliente['Nome'] . ' - ' . $cliente['CPF']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Seção: Informações do Veículo -->

            <div class="form-group">
                <label for="veiculo">Veículo:</label>
                <select id="veiculo" name="veiculo" required>
                    <option value="">Selecione um veículo</option>
                    <?php foreach ($veiculos as $veiculo): ?>
                        <option value="<?php echo $veiculo['ID_Veiculo']; ?>">
                            <?php 
                            $marca = isset($veiculo['Marca']) && !empty($veiculo['Marca']) ? $veiculo['Marca'] : 'Marca não informada';
                            echo $marca . ' ' . $veiculo['Modelo'] . ' - ' . $veiculo['Placa'] . ' - ' . $veiculo['Ano'];
                            ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Seção: Informações do Serviço -->
            <div class="form-section">
                <h3>🔧 Informações do Serviço</h3>
                
                <div class="form-group">
                    <label for="data_abertura">Data de Abertura:</label>
                    <input type="date" id="data_abertura" name="data_abertura" required value="<?php echo date('Y-m-d'); ?>">
                </div>
                
                <div class="form-group">
                    <label for="mecanico">Mecânico Responsável:</label>
                    <select id="mecanico" name="mecanico" required>
                        <option value="">Selecione um mecânico</option>
                        <?php foreach ($mecanicos as $mec): ?>
                            <option value="<?php echo $mec['ID_Mecanico']; ?>">
                                <?php echo $mec['Nome_Mecanico']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="descricao">Descrição do Problema/Serviço:</label>
                    <textarea id="descricao" name="descricao" rows="4" required placeholder="Descreva detalhadamente o problema ou serviço a ser realizado..."></textarea>
                </div>
                
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option value="Aberto">Aberto</option>
                        <option value="Em Andamento">Em Andamento</option>
                        <option value="Aguardando Peças">Aguardando Peças</option>
                        <option value="Concluído">Concluído</option>
                        <option value="Entregue">Entregue</option>
                    </select>
                </div>
            </div>

            <!-- Seção: Valor -->
            <div class="form-section">
                <h3>💰 Valor do Serviço</h3>
                <div class="form-group">
                    <label for="valor">Valor Total (R$):</label>
                    <input type="number" id="valor" name="valor" step="0.01" min="0" placeholder="0.00">
                </div>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Cadastrar Ordem de Serviço</button>
                <a href="listar.php" class="btn btn-secondary">❌ Cancelar</a>
            </div>
        </form>
    </div>

    <script>
        // Validação básica do formulário
        document.querySelector('form').addEventListener('submit', function(e) {
            const cliente = document.getElementById('cliente').value;
            const veiculo = document.getElementById('veiculo').value;
            const mecanico = document.getElementById('mecanico').value;
            
            if (!cliente || !veiculo || !mecanico) {
                e.preventDefault();
                alert('Por favor, preencha todas as informações obrigatórias.');
            }
        });
    </script>
</body>
</html>