<?php
session_start();
include('../config/database.php');

$database = new Database();
$db = $database->getConnection();

// Buscar dados do cliente
$id = $_GET['id'] ?? null;
$cliente = null;

if ($id) {
    $query = "SELECT * FROM Cliente WHERE ID_Cliente = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_POST) {
    try {
        $query = "UPDATE Cliente SET Nome=:nome, CPF=:cpf, Telefone=:telefone, Email=:email WHERE ID_Cliente=:id";
        $stmt = $db->prepare($query);
        
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":email", $email);
        
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Cliente atualizado com sucesso!";
            header("Location: listar.php");
            exit();
        }
    } catch(PDOException $exception) {
        $_SESSION['error_message'] = "Erro ao atualizar cliente: " . $exception->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Editar Cliente</h1>
            <a href="listar.php" class="btn btn-secondary">Voltar</a>
        </header>

        <?php
        if (isset($_SESSION['error_message'])) {
            echo '<div class="alert alert-error">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']);
        }
        ?>

        <?php if ($cliente): ?>
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo $cliente['Nome']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" value="<?php echo $cliente['CPF']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" value="<?php echo $cliente['Telefone']; ?>">
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $cliente['Email']; ?>">
            </div>
            
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
        <?php else: ?>
            <div class="alert alert-error">Cliente não encontrado.</div>
        <?php endif; ?>
    </div>
</body>
</html>