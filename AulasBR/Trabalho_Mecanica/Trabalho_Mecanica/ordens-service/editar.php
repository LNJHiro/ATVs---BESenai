<?php
session_start();
include('../config/database.php');

$database = new Database();
$db = $database->getConnection();

// Buscar dados da OS
$id = $_GET['id'] ?? null;
$os = null;

if ($id) {
    $query = "SELECT * FROM OS WHERE ID_OS = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $os = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Buscar mecânicos para o select
$queryMecanicos = "SELECT * FROM Mecanico";
$stmtMecanicos = $db->prepare($queryMecanicos);
$stmtMecanicos->execute();
$mecanicos = $stmtMecanicos->fetchAll(PDO::FETCH_ASSOC);

if ($_POST) {
    try {
        $query = "UPDATE OS SET Data_Abertura=:data_abertura, Data_Encerramento=:data_encerramento, Descricao_Problema=:descricao, Status=:status, Mecanico_Responsavel=:mecanico, Valor_Total=:valor WHERE ID_OS=:id";
        $stmt = $db->prepare($query);
        
        $data_abertura = $_POST['data_abertura'];
        $data_encerramento = $_POST['data_encerramento'] ?: null;
        $descricao = $_POST['descricao'];
        $status = $_POST['status'];
        $mecanico = $_POST['mecanico'];
        $valor = $_POST['valor'] ?: 0;
        
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":data_abertura", $data_abertura);
        $stmt->bindParam(":data_encerramento", $data_encerramento);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":mecanico", $mecanico);
        $stmt->bindParam(":valor", $valor);
        
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Ordem de Serviço atualizada com sucesso!";
            header("Location: listar.php");
            exit();
        }
    } catch(PDOException $exception) {
        $_SESSION['error_message'] = "Erro ao atualizar OS: " . $exception->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Ordem de Serviço</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Editar Ordem de Serviço</h1>
            <a href="listar.php" class="btn btn-secondary">Voltar</a>
        </header>

        <?php
        if (isset($_SESSION['error_message'])) {
            echo '<div class="alert alert-error">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']);
        }
        ?>

        <?php if ($os): ?>
        <form method="POST">
            <div class="form-group">
                <label for="data_abertura">Data de Abertura:</label>
                <input type="date" id="data_abertura" name="data_abertura" value="<?php echo $os['Data_Abertura']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="data_encerramento">Data de Encerramento:</label>
                <input type="date" id="data_encerramento" name="data_encerramento" value="<?php echo $os['Data_Encerramento']; ?>">
            </div>
            
            <div class="form-group">
                <label for="descricao">Descrição do Problema:</label>
                <textarea id="descricao" name="descricao" rows="4" required><?php echo $os['Descricao_Problema']; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="Aberto" <?php echo ($os['Status'] == 'Aberto') ? 'selected' : ''; ?>>Aberto</option>
                    <option value="Em Andamento" <?php echo ($os['Status'] == 'Em Andamento') ? 'selected' : ''; ?>>Em Andamento</option>
                    <option value="Aguardando Peças" <?php echo ($os['Status'] == 'Aguardando Peças') ? 'selected' : ''; ?>>Aguardando Peças</option>
                    <option value="Concluído" <?php echo ($os['Status'] == 'Concluído') ? 'selected' : ''; ?>>Concluído</option>
                    <option value="Entregue" <?php echo ($os['Status'] == 'Entregue') ? 'selected' : ''; ?>>Entregue</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="mecanico">Mecânico Responsável:</label>
                <select id="mecanico" name="mecanico" required>
                    <option value="">Selecione um mecânico</option>
                    <?php foreach ($mecanicos as $mec): ?>
                        <option value="<?php echo $mec['ID_Mecanico']; ?>" <?php echo ($os['Mecanico_Responsavel'] == $mec['ID_Mecanico']) ? 'selected' : ''; ?>>
                            <?php echo $mec['Nome_Mecanico']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="valor">Valor Total (R$):</label>
                <input type="number" id="valor" name="valor" step="0.01" min="0" value="<?php echo $os['Valor_Total']; ?>">
            </div>
            
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
        <?php else: ?>
            <div class="alert alert-error">Ordem de Serviço não encontrada.</div>
        <?php endif; ?>
    </div>
</body>
</html>