<?php
session_start();
include('../config/database.php');

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        $database = new Database();
        $db = $database->getConnection();
        
        $query = "DELETE FROM Mecanico WHERE ID_Mecanico = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":id", $id);
        
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Mecânico excluído com sucesso!";
        } else {
            $_SESSION['error_message'] = "Erro ao excluir mecânico.";
        }
    } catch(PDOException $exception) {
        $_SESSION['error_message'] = "Erro ao excluir mecânico: " . $exception->getMessage();
    }
} else {
    $_SESSION['error_message'] = "ID do mecânico não especificado.";
}

header("Location: listar.php");
exit();
?>