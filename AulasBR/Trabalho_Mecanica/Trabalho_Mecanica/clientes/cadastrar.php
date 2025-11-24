<?php
session_start();
include('../config/database.php');

if ($_POST) {
    try {
        $database = new Database();
        $db = $database->getConnection();
        
        $cpf = $_POST['cpf'];
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        
        // 1. VERIFICAR SE CPF JÁ EXISTE
        $query_verifica = "SELECT ID_Cliente FROM Cliente WHERE CPF = :cpf";
        $stmt_verifica = $db->prepare($query_verifica);
        $stmt_verifica->bindParam(":cpf", $cpf);
        $stmt_verifica->execute();
        
        if ($stmt_verifica->rowCount() > 0) {
            // CPF já cadastrado
            $_SESSION['error_message'] = "❌ CPF já cadastrado no sistema!";
        } else {
            // CPF não existe, pode cadastrar
            $query = "INSERT INTO Cliente SET Nome=:nome, CPF=:cpf, Telefone=:telefone, Email=:email";
            $stmt = $db->prepare($query);
            
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":cpf", $cpf);
            $stmt->bindParam(":telefone", $telefone);
            $stmt->bindParam(":email", $email);
            
            if ($stmt->execute()) {
                $_SESSION['success_message'] = "✅ Cliente cadastrado com sucesso!";
                header("Location: listar.php");
                exit();
            }
        }
    } catch(PDOException $exception) {
        $_SESSION['error_message'] = "Erro ao cadastrar cliente: " . $exception->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Cliente</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .cpf-error {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 5px;
            display: none;
        }
        .cpf-success {
            color: #27ae60;
            font-size: 0.9rem;
            margin-top: 5px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>👥 Cadastrar Cliente</h1>
            <a href="listar.php" class="btn btn-secondary">⬅️ Voltar</a>
        </header>

        <?php
        if (isset($_SESSION['error_message'])) {
            echo '<div class="alert alert-error">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']);
        }
        ?>

        <form method="POST" id="formCliente">
            <div class="form-group">
                <label for="nome">Nome Completo:</label>
                <input type="text" id="nome" name="nome" required placeholder="Digite o nome completo">
            </div>
            
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" required placeholder="Digite o CPF (apenas números)" maxlength="11" onblur="verificarCPF(this.value)">
                <div id="cpfMessage" class="cpf-error"></div>
            </div>
            
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" placeholder="Digite o telefone">
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Digite o email">
            </div>
            
            <div class="form-actions">
                <button type="submit" id="btnSubmit" class="btn btn-primary">💾 Cadastrar Cliente</button>
                <a href="listar.php" class="btn btn-secondary">❌ Cancelar</a>
            </div>
        </form>
    </div>

    <script>
        // Máscara para CPF
        document.getElementById('cpf').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            e.target.value = value;
        });

        // Máscara para telefone
        document.getElementById('telefone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                if (value.length === 11) {
                    value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
                } else if (value.length === 10) {
                    value = value.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
                }
                e.target.value = value;
            }
        });

        // Função para verificar CPF via AJAX (opcional - verificação em tempo real)
        function verificarCPF(cpf) {
            if (cpf.length === 11) {
                const cpfMessage = document.getElementById('cpfMessage');
                const btnSubmit = document.getElementById('btnSubmit');
                
                // Mostrar carregamento
                cpfMessage.innerHTML = '🔍 Verificando CPF...';
                cpfMessage.className = 'cpf-error';
                cpfMessage.style.display = 'block';
                
                // Fazer requisição AJAX para verificar CPF
                fetch('verificar_cpf.php?cpf=' + cpf)
                    .then(response => response.json())
                    .then(data => {
                        if (data.existe) {
                            cpfMessage.innerHTML = '❌ CPF já cadastrado no sistema!';
                            cpfMessage.className = 'cpf-error';
                            btnSubmit.disabled = true;
                        } else {
                            cpfMessage.innerHTML = '✅ CPF disponível para cadastro';
                            cpfMessage.className = 'cpf-success';
                            btnSubmit.disabled = false;
                        }
                    })
                    .catch(error => {
                        cpfMessage.innerHTML = '⚠️ Erro ao verificar CPF';
                        cpfMessage.className = 'cpf-error';
                        btnSubmit.disabled = false;
                    });
            }
        }

        // Validação do formulário
        document.getElementById('formCliente').addEventListener('submit', function(e) {
            const cpf = document.getElementById('cpf').value;
            if (cpf.length !== 11) {
                e.preventDefault();
                alert('CPF deve ter 11 dígitos!');
                return false;
            }
        });
    </script>
</body>
</html>