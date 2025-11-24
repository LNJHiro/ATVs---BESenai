<?php
session_start();
include('../config/database.php');

if ($_POST) {
    try {
        $database = new Database();
        $db = $database->getConnection();
        
        $id_peca = $_POST['id_peca'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco_custo = $_POST['preco_custo'];
        $preco_venda = $_POST['preco_venda'];
        $quantidade = $_POST['quantidade'];
        $quantidade_minima = $_POST['quantidade_minima'];
        $localizacao = $_POST['localizacao'];
        
        // Verificar se ID da peça já existe
        $query_verifica = "SELECT ID_Peca FROM Peca WHERE ID_Peca = :id_peca";
        $stmt_verifica = $db->prepare($query_verifica);
        $stmt_verifica->bindParam(":id_peca", $id_peca);
        $stmt_verifica->execute();
        
        if ($stmt_verifica->rowCount() > 0) {
            $_SESSION['error_message'] = "❌ Código da peça já existe! Use outro código.";
        } else {
            // Iniciar transação
            $db->beginTransaction();
            
            // Inserir na tabela Peca
            $query_peca = "INSERT INTO Peca (ID_Peca, Nome, Descricao, Preco_Custo, Preco_Venda) 
                          VALUES (:id_peca, :nome, :descricao, :preco_custo, :preco_venda)";
            $stmt_peca = $db->prepare($query_peca);
            
            $stmt_peca->bindParam(":id_peca", $id_peca);
            $stmt_peca->bindParam(":nome", $nome);
            $stmt_peca->bindParam(":descricao", $descricao);
            $stmt_peca->bindParam(":preco_custo", $preco_custo);
            $stmt_peca->bindParam(":preco_venda", $preco_venda);
            
            if ($stmt_peca->execute()) {
                // Inserir na tabela Estoque
                $query_estoque = "INSERT INTO Estoque (ID_Peca, Quantidade, Quantidade_Minima, Localizacao) 
                                 VALUES (:id_peca, :quantidade, :quantidade_minima, :localizacao)";
                $stmt_estoque = $db->prepare($query_estoque);
                
                $stmt_estoque->bindParam(":id_peca", $id_peca);
                $stmt_estoque->bindParam(":quantidade", $quantidade);
                $stmt_estoque->bindParam(":quantidade_minima", $quantidade_minima);
                $stmt_estoque->bindParam(":localizacao", $localizacao);
                
                if ($stmt_estoque->execute()) {
                    $db->commit();
                    $_SESSION['success_message'] = "✅ Peça cadastrada no estoque com sucesso!";
                    header("Location: listar.php");
                    exit();
                }
            }
            
            // Se algo der errado, faz rollback
            $db->rollBack();
            $_SESSION['error_message'] = "Erro ao cadastrar peça.";
        }
    } catch(PDOException $exception) {
        if (isset($db)) {
            $db->rollBack();
        }
        $_SESSION['error_message'] = "Erro ao cadastrar peça: " . $exception->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Peça no Estoque</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .form-section {
            background: #f8f9fa;
            padding: 1.5rem;
            margin: 1rem 0;
            border-radius: 8px;
            border-left: 4px solid #3498db;
        }
        .price-comparison {
            display: flex;
            gap: 1rem;
        }
        .price-comparison .form-group {
            flex: 1;
        }
        .id-example {
            font-size: 0.9rem;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>📦 Cadastrar Peça no Estoque</h1>
            <a href="listar.php" class="btn btn-secondary">⬅️ Voltar</a>
        </header>

        <?php
        if (isset($_SESSION['error_message'])) {
            echo '<div class="alert alert-error">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']);
        }
        ?>

        <form method="POST" id="formPeca">
            <!-- Seção: Código e Informações da Peça -->
            <div class="form-section">
                <h3>🔧 Informações da Peça</h3>
                
                <div class="form-group">
                    <label for="id_peca">Código da Peça:</label>
                    <input type="text" id="id_peca" name="id_peca" required 
                           placeholder="Ex: FILTRO-001, PAST-001" 
                           maxlength="20"
                           pattern="[A-Za-z0-9-]+"
                           title="Use apenas letras, números e hífen">
                    <div class="id-example">Exemplos: FILTRO-001, PAST-BR01, CORR-DENTADA</div>
                </div>
                
                <div class="form-group">
                    <label for="nome">Nome da Peça:</label>
                    <input type="text" id="nome" name="nome" required placeholder="Ex: Filtro de Óleo, Pastilha de Freio">
                </div>
                
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" rows="3" placeholder="Descrição detalhada da peça..."></textarea>
                </div>
                
                <div class="price-comparison">
                    <div class="form-group">
                        <label for="preco_custo">Preço de Custo (R$):</label>
                        <input type="number" id="preco_custo" name="preco_custo" step="0.01" min="0" required placeholder="0.00">
                    </div>
                    
                    <div class="form-group">
                        <label for="preco_venda">Preço de Venda (R$):</label>
                        <input type="number" id="preco_venda" name="preco_venda" step="0.01" min="0" required placeholder="0.00">
                    </div>
                </div>
            </div>

            <!-- Seção: Controle de Estoque -->
            <div class="form-section">
                <h3>📊 Controle de Estoque</h3>
                
                <div class="form-group">
                    <label for="quantidade">Quantidade em Estoque:</label>
                    <input type="number" id="quantidade" name="quantidade" min="0" max="999" required value="0">
                    <small style="color: #666;">Máximo: 999 unidades</small>
                </div>
                
                <div class="form-group">
                    <label for="quantidade_minima">Quantidade Mínima (Alerta):</label>
                    <input type="number" id="quantidade_minima" name="quantidade_minima" min="1" max="999" required value="5">
                    <small style="color: #666;">Sistema alertará quando estoque chegar neste nível</small>
                </div>
                
                <div class="form-group">
                    <label for="localizacao">Localização no Estoque:</label>
                    <input type="text" id="localizacao" name="localizacao" placeholder="Ex: Prateleira A1, Caixa B2">
                </div>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">💾 Cadastrar Peça</button>
                <a href="listar.php" class="btn btn-secondary">❌ Cancelar</a>
            </div>
        </form>
    </div>

    <script>
        // Verificar código da peça em tempo real
        document.getElementById('id_peca').addEventListener('blur', function() {
            const idPeca = this.value;
            if (idPeca.length > 0) {
                // Fazer uppercase automático
                this.value = this.value.toUpperCase();
                
                // Verificar se código já existe
                fetch('verificar_peca.php?codigo=' + idPeca)
                    .then(response => response.json())
                    .then(data => {
                        if (data.existe) {
                            this.style.borderColor = '#e74c3c';
                            alert('❌ Este código de peça já existe! Use outro código.');
                        } else {
                            this.style.borderColor = '#27ae60';
                        }
                    });
            }
        });

        // Calcular margem de lucro em tempo real
        const precoCusto = document.getElementById('preco_custo');
        const precoVenda = document.getElementById('preco_venda');
        
        function calcularMargem() {
            if (precoCusto.value && precoVenda.value) {
                const custo = parseFloat(precoCusto.value);
                const venda = parseFloat(precoVenda.value);
                
                if (venda < custo) {
                    precoVenda.style.borderColor = '#e74c3c';
                } else {
                    precoVenda.style.borderColor = '#27ae60';
                }
            }
        }
        
        precoCusto.addEventListener('input', calcularMargem);
        precoVenda.addEventListener('input', calcularMargem);
    </script>
</body>
</html>