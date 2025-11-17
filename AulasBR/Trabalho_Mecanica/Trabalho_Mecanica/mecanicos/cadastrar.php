<?php
session_start();
include('../config/database.php');

if ($_POST) {
    try {
        $database = new Database();
        $db = $database->getConnection();
        
        $query = "INSERT INTO Mecanico SET Nome_Mecanico=:nome, Telefone=:telefone";
        $stmt = $db->prepare($query);
        
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":telefone", $telefone);
        
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Mecânico cadastrado com sucesso!";
            header("Location: listar.php");
            exit();
        }
    } catch(PDOException $exception) {
        $_SESSION['error_message'] = "Erro ao cadastrar mecânico: " . $exception->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Mecânico</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Cadastrar Mecânico</h1>
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
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone">
            </div>
            
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</body>
</html>