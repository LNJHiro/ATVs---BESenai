<?php
session_start();
include('../config/database.php');

$database = new Database();
$db = $database->getConnection();

// Query SIMPLES para listar veículos - sem JOIN com OS
$query = "SELECT * FROM Veiculo ORDER BY ID_Veiculo DESC";
$stmt = $db->prepare($query);
$stmt->execute();
$veiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Veículos</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>🚗 Veículos Cadastrados</h1>
            <a href="../index.php" class="btn btn-secondary">🏠 Início</a>
            <a href="cadastrar.php" class="btn btn-primary">➕ Novo Veículo</a>
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

        <?php if (count($veiculos) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Placa</th>
                    <th>Ano</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($veiculos as $veiculo): ?>
                <tr>
                    <td><?php echo $veiculo['ID_Veiculo']; ?></td>
                    <td><?php echo $veiculo['Marca'] ?? 'Não informada'; ?></td>
                    <td><?php echo $veiculo['Modelo']; ?></td>
                    <td><?php echo $veiculo['Placa']; ?></td>
                    <td><?php echo $veiculo['Ano']; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $veiculo['ID_Veiculo']; ?>" class="btn btn-warning">✏️ Editar</a>
                        <a href="excluir.php?id=<?php echo $veiculo['ID_Veiculo']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este veículo?')">🗑️ Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <div class="alert alert-info">
                <p>Nenhum veículo cadastrado ainda.</p>
                <a href="cadastrar.php" class="btn btn-primary">Cadastrar Primeiro Veículo</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>