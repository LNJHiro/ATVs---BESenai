<?php
session_start();
include('../config/database.php');

$database = new Database();
$db = $database->getConnection();

$query = "SELECT OS.*, Mecanico.Nome_Mecanico 
          FROM OS 
          LEFT JOIN Mecanico ON OS.Mecanico_Responsavel = Mecanico.ID_Mecanico 
          ORDER BY OS.ID_OS DESC";
$stmt = $db->prepare($query);
$stmt->execute();
$ordens = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Ordens de Serviço</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Ordens de Serviço</h1>
            <a href="../index.php" class="btn btn-secondary">Início</a>
            <a href="cadastrar.php" class="btn btn-primary">Nova OS</a>
        </header>

        <?php
        if (isset($_SESSION['success_message'])) {
            echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
            unset($_SESSION['success_message']);
        }
        ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Data Abertura</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Mecânico</th>
                    <th>Valor Total</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ordens as $os): ?>
                <tr>
                    <td><?php echo $os['ID_OS']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($os['Data_Abertura'])); ?></td>
                    <td><?php echo substr($os['Descricao_Problema'], 0, 50) . '...'; ?></td>
                    <td><?php echo $os['Status']; ?></td>
                    <td><?php echo $os['Nome_Mecanico']; ?></td>
                    <td>R$ <?php echo number_format($os['Valor_Total'], 2, ',', '.'); ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $os['ID_OS']; ?>" class="btn btn-warning">Editar</a>
                        <a href="excluir.php?id=<?php echo $os['ID_OS']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>