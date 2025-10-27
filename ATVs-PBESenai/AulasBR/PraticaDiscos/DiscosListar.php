<?php
include '';

// Conexão com o banco
$conn = new mysqli("localhost", "root", "SenaiSp", "PraticaDiscos");

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM discos ORDER BY artista, titulo");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Coleção de Discos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            background: #34495e;
            color: white;
            padding: 12px;
            text-align: left;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .btn {
            display: inline-block;
            padding: 8px 15px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .btn:hover {
            background: #2980b9;
        }
        .btn-voltar {
            background: #e74c3c;
        }
        .btn-voltar:hover {
            background: #c0392b;
        }
        .empty-message {
            text-align: center;
            padding: 40px;
            color: #7f8c8d;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎵 Minha Coleção de Discos</h1>
        
        <?php
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Artista</th>
                    <th>Ano</th>
                    <th>Gênero</th>
                    <th>Ações</th>
                  </tr>";
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td><strong>{$row['titulo']}</strong></td>
                        <td>{$row['artista']}</td>
                        <td>{$row['ano_lancamento']}</td>
                        <td>{$row['genero']}</td>
                        <td>
                            <a href='editar.php?id={$row['id']}' class='btn'>Editar</a>
                        </td>
                      </tr>";
            }
            echo "</table>";
            
            // Mostra quantos discos tem na coleção
            echo "<p><strong>Total de discos na coleção: {$result->num_rows}</strong></p>";
        } else {
            echo "<div class='empty-message'>
                    <p>🎵 Nenhum disco cadastrado ainda!</p>
                    <p>Comece adicionando alguns discos à sua coleção.</p>
                  </div>";
        }
        
        $conn->close();
        ?>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="DiscoIndex.html" class="btn btn-voltar">Cadastrar Novo Disco</a>
        </div>
    </div>
</body>
</html>