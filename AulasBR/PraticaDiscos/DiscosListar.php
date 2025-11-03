<?php
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
            min-height: 100vh;
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
            background: white;
        }
        th {
            background: #34495e;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: bold;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        tr:hover {
            background-color: #e9ecef;
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }
        .btn {
            display: inline-block;
            padding: 8px 15px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .btn-voltar {
            background: #e74c3c;
            padding: 12px 25px;
            font-size: 16px;
        }
        .btn-voltar:hover {
            background: #c0392b;
        }
        .btn-editar {
            background: #27ae60;
        }
        .btn-editar:hover {
            background: #219a52;
        }
        .empty-message {
            text-align: center;
            padding: 40px;
            color: #7f8c8d;
            font-size: 18px;
            background: white;
            border-radius: 10px;
            margin: 20px 0;
        }
        .total-discos {
            text-align: center;
            font-size: 18px;
            color: #2c3e50;
            margin: 20px 0;
            padding: 15px;
            background: #ecf0f1;
            border-radius: 8px;
            font-weight: bold;
        }
        .actions-cell {
            text-align: center;
            white-space: nowrap;
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
                    <th class='actions-cell'>Ações</th>
                  </tr>";
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td><strong>{$row['titulo']}</strong></td>
                        <td>{$row['artista']}</td>
                        <td>{$row['ano_lancamento']}</td>
                        <td>{$row['genero']}</td>
                        <td class='actions-cell'>
                            <a href='DiscosEditar.php?id={$row['id']}' class='btn btn-editar'>Editar</a>
                        </td>
                      </tr>";
            }
            echo "</table>";
            
            // Mostra quantos discos tem na coleção
            echo "<div class='total-discos'>Total de discos na coleção: {$result->num_rows}</div>";
        } else {
            echo "<div class='empty-message'>
                    <p style='font-size: 24px; margin-bottom: 10px;'>🎵</p>
                    <p style='font-size: 20px; margin-bottom: 10px;'><strong>Nenhum disco cadastrado ainda!</strong></p>
                    <p>Comece adicionando alguns discos à sua coleção.</p>
                  </div>";
        }
        
        $conn->close();
        ?>
        
        <div style="text-align: center; margin-top: 30px;">
            <a href="DiscosIndex.html" class="btn btn-voltar">🎵 Cadastrar Novo Disco</a>
        </div>
    </div>
</body>
</html>