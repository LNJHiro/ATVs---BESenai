<?php
include('../config/database.php');

if (isset($_GET['codigo'])) {
    $codigo = strtoupper($_GET['codigo']);
    
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "SELECT ID_Peca FROM Peca WHERE ID_Peca = :codigo";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":codigo", $codigo);
    $stmt->execute();
    
    header('Content-Type: application/json');
    
    if ($stmt->rowCount() > 0) {
        echo json_encode(['existe' => true]);
    } else {
        echo json_encode(['existe' => false]);
    }
} else {
    echo json_encode(['existe' => false]);
}
?>