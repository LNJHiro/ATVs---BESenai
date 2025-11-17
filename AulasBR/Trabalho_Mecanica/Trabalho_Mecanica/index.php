<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Oficina Mecânica</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>🏗️ Sistema de Gerenciamento - Oficina Mecânica</h1>
        </header>
        
        <nav class="menu">
            <ul>
                <li><a href="clientes/listar.php">👥 Clientes</a></li>
                <li><a href="veiculos/listar.php">🚗 Veículos</a></li>
                <li><a href="mecanicos/listar.php">🔧 Mecânicos</a></li>
                <li><a href="ordens-service/listar.php">📋 Ordens de Serviço</a></li>
            </ul>
        </nav>
        
        <main>
            <div class="welcome">
                <h2>Bem-vindo ao Sistema da Oficina!</h2>
                <p>Gerencie clientes, veículos, mecânicos e ordens de serviço de forma simples e eficiente.</p>
                
                <div class="stats">
                    <div class="stat-card">
                        <h3>📊 Estatísticas Rápidas</h3>
                        <p>Use o menu acima para acessar as funcionalidades do sistema.</p>
                    </div>
                </div>

                <div class="quick-actions">
                    <h3>⚡ Ações Rápidas</h3>
                    <div class="action-buttons">
                        <a href="clientes/cadastrar.php" class="btn btn-primary">Novo Cliente</a>
                        <a href="veiculos/cadastrar.php" class="btn btn-primary">Novo Veículo</a>
                        <a href="mecanicos/cadastrar.php" class="btn btn-primary">Novo Mecânico</a>
                        <a href="ordens-service/cadastrar.php" class="btn btn-primary">Nova OS</a>
                    </div>
                </div>
            </div>
        </main>

        <footer style="margin-top: 3rem; text-align: center; padding: 1rem; color: #7f8c8d;">
            <p>Sistema desenvolvido para gerenciamento de oficina mecânica</p>
        </footer>
    </div>
</body>
</html>