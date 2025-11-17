<?php
session_start();
include('../config/database.php');

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        $database = new Database();
        $db = $database->getConnection();
        
        $query = "DELETE FROM Veiculo WHERE ID_Veiculo = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":id", $id);
        
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Veículo excluído com sucesso!";
        } else {
            $_SESSION['error_message'] = "Erro ao excluir veículo.";
        }
    } catch(PDOException $exception) {
        $_SESSION['error_message'] = "Erro ao excluir veículo: " . $exception->getMessage();
    }
} else {
    $_SESSION['error_message'] = "ID do veículo não especificado.";
}

header("Location: listar.php");
exit();
?>