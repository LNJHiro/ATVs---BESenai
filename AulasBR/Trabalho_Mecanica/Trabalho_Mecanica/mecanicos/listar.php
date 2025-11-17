<?php
session_start();
include('../config/database.php');

$database = new Database();
$db = $database->getConnection();

$query = "SELECT * FROM Mecanico ORDER BY ID_Mecanico DESC";
$stmt = $db->prepare($query);
$stmt->execute();
$mecanicos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Mecânicos</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Mecânicos Cadastrados</h1>
            <a href="../index.php" class="btn btn-secondary">Início</a>
            <a href="cadastrar.php" class="btn btn-primary">Novo Mecânico</a>
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
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mecanicos as $mecanico): ?>
                <tr>
                    <td><?php echo $mecanico['ID_Mecanico']; ?></td>
                    <td><?php echo $mecanico['Nome_Mecanico']; ?></td>
                    <td><?php echo $mecanico['Telefone']; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $mecanico['ID_Mecanico']; ?>" class="btn btn-warning">Editar</a>
                        <a href="excluir.php?id=<?php echo $mecanico['ID_Mecanico']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>