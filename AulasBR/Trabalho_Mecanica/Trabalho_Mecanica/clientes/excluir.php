<?php
session_start();
include('../config/database.php');

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        $database = new Database();
        $db = $database->getConnection();
        
        $query = "DELETE FROM Cliente WHERE ID_Cliente = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":id", $id);
        
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Cliente excluído com sucesso!";
        } else {
            $_SESSION['error_message'] = "Erro ao excluir cliente.";
        }
    } catch(PDOException $exception) {
        $_SESSION['error_message'] = "Erro ao excluir cliente: " . $exception->getMessage();
    }
} else {
    $_SESSION['error_message'] = "ID do cliente não especificado.";
}

header("Location: listar.php");
exit();
?>