<?php
session_start();
include('../config/database.php');

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        $database = new Database();
        $db = $database->getConnection();
        
        // Primeiro verificar se a peça existe
        $query_verifica = "SELECT p.Nome, e.Quantidade 
                          FROM Peca p 
                          INNER JOIN Estoque e ON p.ID_Peca = e.ID_Peca 
                          WHERE p.ID_Peca = :id";
        $stmt_verifica = $db->prepare($query_verifica);
        $stmt_verifica->bindParam(":id", $id);
        $stmt_verifica->execute();
        $peca_info = $stmt_verifica->fetch(PDO::FETCH_ASSOC);
        
        if (!$peca_info) {
            $_SESSION['error_message'] = "Peça não encontrada.";
            header("Location: listar.php");
            exit();
        }
        
        // Verificar se há estoque antes de excluir
        if ($peca_info['Quantidade'] > 0) {
            $_SESSION['error_message'] = "❌ Não é possível excluir a peça <strong>'{$peca_info['Nome']}'</strong> porque ainda há <strong>{$peca_info['Quantidade']} unidades</strong> em estoque. <br>Primeiro zere o estoque antes de excluir.";
            header("Location: listar.php");
            exit();
        }
        
        // Iniciar transação
        $db->beginTransaction();
        
        // Primeiro excluir da tabela Estoque (devido à chave estrangeira)
        $query_estoque = "DELETE FROM Estoque WHERE ID_Peca = :id";
        $stmt_estoque = $db->prepare($query_estoque);
        $stmt_estoque->bindParam(":id", $id);
        $stmt_estoque->execute();
        
        // Depois excluir da tabela Peca
        $query_peca = "DELETE FROM Peca WHERE ID_Peca = :id";
        $stmt_peca = $db->prepare($query_peca);
        $stmt_peca->bindParam(":id", $id);
        $stmt_peca->execute();
        
        // Confirmar transação
        $db->commit();
        
        $_SESSION['success_message'] = "✅ Peça <strong>'{$peca_info['Nome']}'</strong> excluída com sucesso!";
        
    } catch(PDOException $exception) {
        // Reverter transação em caso de erro
        if (isset($db)) {
            $db->rollBack();
        }
        
        // Verificar se é erro de chave estrangeira
        if (strpos($exception->getMessage(), 'foreign key constraint') !== false) {
            $_SESSION['error_message'] = "❌ Não é possível excluir esta peça porque ela está sendo usada em ordens de serviço.";
        } else {
            $_SESSION['error_message'] = "Erro ao excluir peça: " . $exception->getMessage();
        }
    }
} else {
    $_SESSION['error_message'] = "ID da peça não especificado.";
}

header("Location: listar.php");
exit();
?>