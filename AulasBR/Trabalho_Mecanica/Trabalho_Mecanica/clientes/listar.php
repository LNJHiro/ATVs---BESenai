<?php
session_start();
include('../config/database.php');

$database = new Database();
$db = $database->getConnection();

$query = "SELECT * FROM Cliente ORDER BY ID_Cliente DESC";
$stmt = $db->prepare($query);
$stmt->execute();
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>👥 Clientes Cadastrados</h1>
            <a href="../index.php" class="btn btn-secondary">🏠 Início</a>
            <a href="cadastrar.php" class="btn btn-primary">➕ Novo Cliente</a>
        </header>

        <?php
        if (isset($_SESSION['success_message'])) {
            echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
            unset($_SESSION['success_message']);
        }
        
        if (isset($_SESSION['error_message'])) {
            echo '<div class="alert alert-error">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']);
        }
        ?>

        <?php if (count($clientes) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?php echo $cliente['ID_Cliente']; ?></td>
                    <td><?php echo $cliente['Nome']; ?></td>
                    <td><?php echo $cliente['CPF']; ?></td>
                    <td><?php echo $cliente['Telefone']; ?></td>
                    <td><?php echo $cliente['Email']; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $cliente['ID_Cliente']; ?>" class="btn btn-warning">✏️ Editar</a>
                        <a href="excluir.php?id=<?php echo $cliente['ID_Cliente']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">🗑️ Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <div class="alert alert-info">
                <p>Nenhum cliente cadastrado ainda.</p>
                <a href="cadastrar.php" class="btn btn-primary">Cadastrar Primeiro Cliente</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>