<?php
session_start();
include('../config/database.php');

$database = new Database();
$db = $database->getConnection();

$id = $_GET['id'] ?? null;
$veiculo = null;

if ($id) {
    $query = "SELECT * FROM Veiculo WHERE ID_Veiculo = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $veiculo = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_POST) {
    try {
        $query = "UPDATE Veiculo SET Placa=:placa, Modelo=:modelo, Ano=:ano WHERE ID_Veiculo=:id";
        $stmt = $db->prepare($query);
        
        $placa = $_POST['placa'];
        $modelo = $_POST['modelo'];
        $ano = $_POST['ano'];
        
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":placa", $placa);
        $stmt->bindParam(":modelo", $modelo);
        $stmt->bindParam(":ano", $ano);
        
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Veículo atualizado com sucesso!";
            header("Location: listar.php");
            exit();
        }
    } catch(PDOException $exception) {
        $_SESSION['error_message'] = "Erro ao atualizar veículo: " . $exception->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Veículo</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Editar Veículo</h1>
            <a href="listar.php" class="btn btn-secondary">Voltar</a>
        </header>

        <?php
        if (isset($_SESSION['error_message'])) {
            echo '<div class="alert alert-error">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']);
        }
        ?>

        <?php if ($veiculo): ?>
        <form method="POST">
            <div class="form-group">
                <label for="placa">Placa:</label>
                <input type="text" id="placa" name="placa" value="<?php echo $veiculo['Placa']; ?>" required maxlength="7">
            </div>
            
            <div class="form-group">
                <label for="modelo">Modelo:</label>
                <input type="text" id="modelo" name="modelo" value="<?php echo $veiculo['Modelo']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="ano">Ano:</label>
                <input type="number" id="ano" name="ano" value="<?php echo $veiculo['Ano']; ?>" required min="1900" max="2030">
            </div>
            
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
        <?php else: ?>
            <div class="alert alert-error">Veículo não encontrado.</div>
        <?php endif; ?>
    </div>
</body>
</html>