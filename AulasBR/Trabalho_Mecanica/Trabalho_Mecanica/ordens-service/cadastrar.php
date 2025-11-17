<?php
session_start();
include('../config/database.php');

$database = new Database();
$db = $database->getConnection();

// Buscar mecânicos para o select
$queryMecanicos = "SELECT * FROM Mecanico";
$stmtMecanicos = $db->prepare($queryMecanicos);
$stmtMecanicos->execute();
$mecanicos = $stmtMecanicos->fetchAll(PDO::FETCH_ASSOC);

// Buscar veículos para o select
$queryVeiculos = "SELECT * FROM Veiculo";
$stmtVeiculos = $db->prepare($queryVeiculos);
$stmtVeiculos->execute();
$veiculos = $stmtVeiculos->fetchAll(PDO::FETCH_ASSOC);

if ($_POST) {
    try {
        $query = "INSERT INTO OS SET Data_Abertura=:data_abertura, Descricao_Problema=:descricao, Status=:status, Mecanico_Responsavel=:mecanico, Valor_Total=:valor";
        $stmt = $db->prepare($query);
        
        $data_abertura = $_POST['data_abertura'];
        $descricao = $_POST['descricao'];
        $status = $_POST['status'];
        $mecanico = $_POST['mecanico'];
        $valor = $_POST['valor'] ?: 0;
        
        $stmt->bindParam(":data_abertura", $data_abertura);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":mecanico", $mecanico);
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
</head>
<body>
    <div class="container">
        <header>
            <h1>Cadastrar Ordem de Serviço</h1>
            <a href="listar.php" class="btn btn-secondary">Voltar</a>
        </header>

        <?php
        if (isset($_SESSION['error_message'])) {
            echo '<div class="alert alert-error">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']);
        }
        ?>

        <form method="POST">
            <div class="form-group">
                <label for="data_abertura">Data de Abertura:</label>
                <input type="date" id="data_abertura" name="data_abertura" required value="<?php echo date('Y-m-d'); ?>">
            </div>
            
            <div class="form-group">
                <label for="descricao">Descrição do Problema:</label>
                <textarea id="descricao" name="descricao" rows="4" required></textarea>
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
            
            <div class="form-group">
                <label for="mecanico">Mecânico Responsável:</label>
                <select id="mecanico" name="mecanico" required>
                    <option value="">Selecione um mecânico</option>
                    <?php foreach ($mecanicos as $mec): ?>
                        <option value="<?php echo $mec['ID_Mecanico']; ?>"><?php echo $mec['Nome_Mecanico']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="valor">Valor Total (R$):</label>
                <input type="number" id="valor" name="valor" step="0.01" min="0">
            </div>
            
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</body>
</html>