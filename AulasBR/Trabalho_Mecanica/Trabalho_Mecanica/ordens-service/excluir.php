<?php
session_start();
include('../config/database.php');

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        $database = new Database();
        $db = $database->getConnection();
        
        $query = "DELETE FROM OS WHERE ID_OS = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":id", $id);
        
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Ordem de Serviço excluída com sucesso!";
        } else {
            $_SESSION['error_message'] = "Erro ao excluir ordem de serviço.";
        }
    } catch(PDOException $exception) {
        $_SESSION['error_message'] = "Erro ao excluir ordem de serviço: " . $exception->getMessage();
    }
} else {
    $_SESSION['error_message'] = "ID da ordem de serviço não especificado.";
}

header("Location: listar.php");
exit();
?>