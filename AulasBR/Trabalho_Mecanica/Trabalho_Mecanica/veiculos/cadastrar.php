<?php
session_start();
include('../config/database.php');

if ($_POST) {
    try {
        $database = new Database();
        $db = $database->getConnection();
        
        $query = "INSERT INTO Veiculo SET Placa=:placa, Modelo=:modelo, Ano=:ano";
        $stmt = $db->prepare($query);
        
        $placa = $_POST['placa'];
        $modelo = $_POST['modelo'];
        $ano = $_POST['ano'];
        
        $stmt->bindParam(":placa", $placa);
        $stmt->bindParam(":modelo", $modelo);
        $stmt->bindParam(":ano", $ano);
        
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Veículo cadastrado com sucesso!";
            header("Location: listar.php");
            exit();
        }
    } catch(PDOException $exception) {
        $_SESSION['error_message'] = "Erro ao cadastrar veículo: " . $exception->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Veículo</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Cadastrar Veículo</h1>
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
                <label for="placa">Placa:</label>
                <input type="text" id="placa" name="placa" required maxlength="7">
            </div>
            
            <div class="form-group">
                <label for="modelo">Modelo:</label>
                <input type="text" id="modelo" name="modelo" required>
            </div>
            
            <div class="form-group">
                <label for="ano">Ano:</label>
                <input type="number" id="ano" name="ano" required min="1900" max="2030">
            </div>
            
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</body>
</html>