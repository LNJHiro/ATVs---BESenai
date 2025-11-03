<?php
// Conexão com o banco
$conn = new mysqli("localhost", "root", "SenaiSp", "PraticaDiscos");

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se o ID foi passado
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID do disco não especificado");
}

$id = $conn->real_escape_string($_GET['id']);

// Busca os dados do disco
$result = $conn->query("SELECT * FROM discos WHERE id = $id");
$disco = $result->fetch_assoc();

// Verifica se o disco existe
if (!$disco) {
    die("Disco não encontrado");
}

// Processa o formulário de edição
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $conn->real_escape_string($_POST['titulo']);
    $artista = $conn->real_escape_string($_POST['artista']);
    $ano_lancamento = $conn->real_escape_string($_POST['ano_lancamento']);
    $genero = $conn->real_escape_string($_POST['genero']);
    
    // Atualiza no banco
    $sql = "UPDATE discos SET 
            titulo = '$titulo', 
            artista = '$artista', 
            ano_lancamento = '$ano_lancamento', 
            genero = '$genero' 
            WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        $message = "Disco atualizado com sucesso! 🎵";
        $status = "sucesso";
        
        // Atualiza os dados locais
        $disco['titulo'] = $_POST['titulo'];
        $disco['artista'] = $_POST['artista'];
        $disco['ano_lancamento'] = $_POST['ano_lancamento'];
        $disco['genero'] = $_POST['genero'];
    } else {
        $message = "Erro ao atualizar: " . $conn->error;
        $status = "erro";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Disco</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 20px;
            color: white;
            min-height: 100vh;
        }
        .container {
            max-width: 500px;
            margin: 30px auto;
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.95);
            font-size: 16px;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }
        input:focus, select:focus {
            outline: none;
            background: white;
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.3);
            transform: translateY(-2px);
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            margin: 10px 5px;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: bold;
            border: none;
            cursor: pointer;
            text-align: center;
        }
        .btn-submit {
            background: #27ae60;
            width: 100%;
            font-size: 18px;
        }
        .btn-submit:hover {
            background: #219a52;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(39, 174, 96, 0.4);
        }
        .btn-cancel {
            background: #95a5a6;
        }
        .btn-cancel:hover {
            background: #7f8c8d;
        }
        .message {
            padding: 15px;
            margin: 20px 0;
            border-radius: 8px;
            font-weight: bold;
            text-align: center;
        }
        .sucesso {
            background: #4CAF50;
            color: white;
            border: 2px solid #45a049;
        }
        .erro {
            background: #f44336;
            color: white;
            border: 2px solid #d32f2f;
        }
        .btn-container {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>✏️ Editar Disco</h1>
        
        <?php if (isset($message)): ?>
            <div class="message <?php echo $status; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <form action="editar.php?id=<?php echo $id; ?>" method="POST">
            <div class="form-group">
                <label for="titulo">Título do Álbum:</label>
                <input type="text" id="titulo" name="titulo" required 
                       value="<?php echo htmlspecialchars($disco['titulo']); ?>"
                       placeholder="Ex: The Dark Side of the Moon">
            </div>
            
            <div class="form-group">
                <label for="artista">Artista/Banda:</label>
                <input type="text" id="artista" name="artista" required 
                       value="<?php echo htmlspecialchars($disco['artista']); ?>"
                       placeholder="Ex: Pink Floyd">
            </div>
            
            <div class="form-group">
                <label for="ano_lancamento">Ano de Lançamento:</label>
                <input type="number" id="ano_lancamento" name="ano_lancamento" 
                       value="<?php echo htmlspecialchars($disco['ano_lancamento']); ?>"
                       min="1900" max="2024" placeholder="Ex: 1973">
            </div>
            
            <div class="form-group">
                <label for="genero">Gênero Musical:</label>
                <input type="text" id="genero" name="genero" 
                       value="<?php echo htmlspecialchars($disco['genero']); ?>"
                       placeholder="Ex: Rock Progressivo, Heavy Metal...">
            </div>
            
            <div class="btn-container">
                <button type="submit" class="btn btn-submit">💾 Salvar Alterações</button>
            </div>
        </form>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="DiscosListar.php" class="btn btn-cancel">↩️ Voltar para Lista</a>
        </div>
    </div>
</body>
</html>