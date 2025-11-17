<?php
session_start();
include('../config/database.php');

$database = new Database();
$db = $database->getConnection();

$id = $_GET['id'] ?? null;
$mecanico = null;

if ($id) {
    $query = "SELECT * FROM Mecanico WHERE ID_Mecanico = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $mecanico = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_POST) {
    try {
        $query = "UPDATE Mecanico SET Nome_Mecanico=:nome, Telefone=:telefone WHERE ID_Mecanico=:id";
        $stmt = $db->prepare($query);
        
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":telefone", $telefone);
        
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Mecânico atualizado com sucesso!";
            header("Location: listar.php");
            exit();
        }
    } catch(PDOException $exception) {
        $_SESSION['error_message'] = "Erro ao atualizar mecânico: " . $exception->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Mecânico</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Editar Mecânico</h1>
            <a href="listar.php" class="btn btn-secondary">Voltar</a>
        </header>

        <?php
        if (isset($_SESSION['error_message'])) {
            echo '<div class="alert alert-error">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']);
        }
        ?>

        <?php if ($mecanico): ?>
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo $mecanico['Nome_Mecanico']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" value="<?php echo $mecanico['Telefone']; ?>">
            </div>
            
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
        <?php else: ?>
            <div class="alert alert-error">Mecânico não encontrado.</div>
        <?php endif; ?>
    </div>
</body>
</html>