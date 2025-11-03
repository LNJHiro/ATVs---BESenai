<?php
// Recebe os dados do formulário
$TITULO = $_POST['titulo'];
$ARTISTA = $_POST['artista'];
$ANO_LANCAMENTO = $_POST['ano_lancamento'];
$GENERO = $_POST['genero'];

// Conexão com o banco
$conn = new mysqli("localhost", "root", "SenaiSp", "PraticaDiscos");

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    $message = "Falha na conexão: " . $conn->connect_error;
    $status = "erro";
} else {
    // Monta o comando SQL
    $sql = "INSERT INTO discos (titulo, artista, ano_lancamento, genero)
            VALUES ('$TITULO', '$ARTISTA', '$ANO_LANCAMENTO', '$GENERO')";

    // Executa o comando SQL
    if ($conn->query($sql) === TRUE) {
        $message = "Disco cadastrado com sucesso! 🎵";
        $status = "sucesso";
    } else {
        $message = "Erro: " . $conn->error;
        $status = "erro";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Cadastro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 20px;
            color: white;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            text-align: center;
        }
        .message {
            padding: 15px;
            margin: 20px 0;
            border-radius: 8px;
            font-weight: bold;
        }
        .sucesso {
            background: #4CAF50;
            color: white;
        }
        .erro {
            background: #f44336;
            color: white;
        }
        .btn-voltar {
            display: inline-block;
            padding: 10px 20px;
            background: #ff6b6b;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .btn-voltar:hover {
            background: #ff5252;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎵 Cadastro de Disco</h1>
        <div class="message <?php echo $status; ?>">
            <?php echo $message; ?>
        </div>
        <a href="DiscosIndex.html" class="btn-voltar">Voltar ao Formulário</a>
    </div>
    <div class="container">
        <h1>🎵 Lista de discos</h1>
        <div class="message <?php echo $status; ?>">
            <?php echo $message; ?>
        </div>
        <a href="DiscosListar.php" class="btn-voltar">Lista de Discos</a>
    </div>

</body>
</html>