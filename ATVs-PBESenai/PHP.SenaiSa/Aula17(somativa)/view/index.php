<?php
require_once __DIR__ . '/../controller/LivroController.php';

$controller = new LivroController();
$acao = $_POST['acao'] ?? '';
$editarLivro = null;

// --- Processamento das ações ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // CRIAR novo livro
    if ($acao === 'criar') {
        $controller->criar(
            trim($_POST['titulo']),
            trim($_POST['genero_literario']),
            trim($_POST['autor']),
            (int) $_POST['ano_publicacao'],
            (int) $_POST['qtde']
        );
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    }

    // DELETAR livro existente
    if ($acao === 'deletar') {
        $controller->deletar(trim($_POST['titulo']));
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    }

    // ENTRAR NO MODO DE EDIÇÃO
    if ($acao === 'editar') {
        $editarLivro = $controller->buscarPorTitulo(trim($_POST['titulo']));
    }

    // ATUALIZAR livro existente
    if ($acao === 'atualizar') {
        $controller->atualizar(
            trim($_POST['titulo_original']),
            trim($_POST['titulo']),
            trim($_POST['genero_literario']),
            trim($_POST['autor']),
            (int) $_POST['ano_publicacao'],
            (int) $_POST['qtde']
        );
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    }
}

// LER livros cadastrados
$lista = $controller->ler();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca Irmã Maria de Santo Inocêncio Lima - Gerenciamento de Livros</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Reset e configurações gerais */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
            background-image: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.85);
            z-index: -1;
        }

        /* Container principal */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Cabeçalho */
        header {
            text-align: center;
            padding: 30px 0;
            background: linear-gradient(135deg, #2c3e50, #4a6491);
            color: white;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.1)"/></svg>');
            background-size: cover;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 300;
            letter-spacing: 1px;
        }

        h2 {
            font-size: 1.8rem;
            font-weight: 400;
            margin-bottom: 5px;
        }

        /* Formulários */
        .form-container {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            transition: transform 0.3s ease;
        }

        .form-container:hover {
            transform: translateY(-5px);
        }

        form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            align-items: end;
        }

        input, select, button {
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #4a6491;
            box-shadow: 0 0 0 2px rgba(74, 100, 145, 0.2);
        }

        button {
            background: linear-gradient(to right, #4a6491, #2c3e50);
            color: white;
            border: none;
            cursor: pointer;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        button:hover {
            background: linear-gradient(to right, #3a5479, #1c2a3a);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Tabela */
        .table-container {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: linear-gradient(135deg, #4a6491, #2c3e50);
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 500;
        }

        td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f0f4f8;
        }

        /* Botões de ação na tabela */
        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .action-buttons form {
            display: inline;
        }

        .btn-edit {
            background: linear-gradient(to right, #3498db, #2980b9);
            padding: 8px 15px;
            font-size: 0.9rem;
        }

        .btn-delete {
            background: linear-gradient(to right, #e74c3c, #c0392b);
            padding: 8px 15px;
            font-size: 0.9rem;
        }

        .btn-edit:hover {
            background: linear-gradient(to right, #2980b9, #21618c);
        }

        .btn-delete:hover {
            background: linear-gradient(to right, #c0392b, #a93226);
        }

        /* Mensagens e estados */
        .empty-message {
            text-align: center;
            padding: 20px;
            color: #7f8c8d;
            font-style: italic;
        }

        hr {
            border: none;
            height: 1px;
            background: linear-gradient(to right, transparent, #ddd, transparent);
            margin: 25px 0;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            form {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            h1 {
                font-size: 2rem;
            }
            
            h2 {
                font-size: 1.5rem;
            }
        }

        /* Animações */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-container, .table-container {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Biblioteca Irmã Maria de Santo Inocêncio Lima</h1>
            <h2>Gerenciamento de Livros</h2>
        </header>

        <hr>

        <?php if ($editarLivro): ?>
            <!-- Formulário de atualização -->
            <div class="form-container">
                <form method="POST">
                    <input type="hidden" name="acao" value="atualizar">
                    <input type="hidden" name="titulo_original" value="<?= htmlspecialchars($editarLivro->getTitulo()) ?>">

                    <input type="text" name="titulo" placeholder="Título do livro:" required value="<?= htmlspecialchars($editarLivro->getTitulo()) ?>">

                    <select name="genero_literario" required>
                        <option value="">Selecione o gênero literário</option>
                        <option value="Romance" <?= $editarLivro->getGeneroLiterario() === 'Romance' ? 'selected' : '' ?>>Romance</option>
                        <option value="Ficção Científica" <?= $editarLivro->getGeneroLiterario() === 'Ficção Científica' ? 'selected' : '' ?>>Ficção Científica</option>
                        <option value="Fantasia" <?= $editarLivro->getGeneroLiterario() === 'Fantasia' ? 'selected' : '' ?>>Fantasia</option>
                        <option value="Suspense" <?= $editarLivro->getGeneroLiterario() === 'Suspense' ? 'selected' : '' ?>>Suspense</option>
                        <option value="Terror" <?= $editarLivro->getGeneroLiterario() === 'Terror' ? 'selected' : '' ?>>Terror</option>
                        <option value="Biografia" <?= $editarLivro->getGeneroLiterario() === 'Biografia' ? 'selected' : '' ?>>Biografia</option>
                        <option value="História" <?= $editarLivro->getGeneroLiterario() === 'História' ? 'selected' : '' ?>>História</option>
                        <option value="Poesia" <?= $editarLivro->getGeneroLiterario() === 'Poesia' ? 'selected' : '' ?>>Poesia</option>
                        <option value="Drama" <?= $editarLivro->getGeneroLiterario() === 'Drama' ? 'selected' : '' ?>>Drama</option>
                        <option value="Infantil" <?= $editarLivro->getGeneroLiterario() === 'Infantil' ? 'selected' : '' ?>>Infantil</option>
                        <option value="Didático" <?= $editarLivro->getGeneroLiterario() === 'Didático' ? 'selected' : '' ?>>Didático</option>
                    </select>

                    <input type="text" name="autor" placeholder="Autor do livro:" required value="<?= htmlspecialchars($editarLivro->getAutor()) ?>">
                    <input type="number" name="ano_publicacao" min="1000" max="<?= date('Y') ?>" placeholder="Ano de Publicação:" required value="<?= htmlspecialchars($editarLivro->getAnoPublicacao()) ?>">
                    <input type="number" name="qtde" min="0" placeholder="Quantidade em estoque:" required value="<?= htmlspecialchars($editarLivro->getQtde()) ?>">

                    <button type="submit">Atualizar Livro</button>
                </form>
            </div>

        <?php else: ?>
            <!-- Formulário de criação -->
            <div class="form-container">
                <form method="POST">
                    <input type="hidden" name="acao" value="criar">
                    <input type="text" name="titulo" placeholder="Título do livro:" required>
                    <select name="genero_literario" required>
                        <option value="">Selecione o gênero literário</option>
                        <option value="Romance">Romance</option>
                        <option value="Ficção Científica">Ficção Científica</option>
                        <option value="Fantasia">Fantasia</option>
                        <option value="Suspense">Suspense</option>
                        <option value="Terror">Terror</option>
                        <option value="Biografia">Biografia</option>
                        <option value="História">História</option>
                        <option value="Poesia">Poesia</option>
                        <option value="Drama">Drama</option>
                        <option value="Infantil">Infantil</option>
                        <option value="Didático">Didático</option>
                    </select>
                    <input type="text" name="autor" placeholder="Autor do livro:" required>
                    <input type="number" name="ano_publicacao" min="1000" max="<?= date('Y') ?>" placeholder="Ano de Publicação:" required>
                    <input type="number" name="qtde" min="0" placeholder="Quantidade em estoque:" required>
                    <button type="submit">Cadastrar Livro</button>
                </form>
            </div>
        <?php endif; ?>

        <hr>

        <h2>Acervo de Livros</h2>

        <div class="table-container">
            <table>
                <tr>
                    <th>Título</th>
                    <th>Gênero Literário</th>
                    <th>Autor</th>
                    <th>Ano Publicação</th>
                    <th>Quantidade</th>
                    <th>Ações</th>
                </tr>

                <?php if (!empty($lista)): ?>
                    <?php foreach ($lista as $livro): ?>
                        <tr>
                            <td><?= htmlspecialchars($livro->getTitulo()) ?></td>
                            <td><?= htmlspecialchars($livro->getGeneroLiterario()) ?></td>
                            <td><?= htmlspecialchars($livro->getAutor()) ?></td>
                            <td><?= htmlspecialchars($livro->getAnoPublicacao()) ?></td>
                            <td><?= htmlspecialchars($livro->getQtde()) ?></td>
                            <td>
                                <div class="action-buttons">
                                    <!-- Botão Editar -->
                                    <form method="post" style="display:inline;">
                                        <input type="hidden" name="acao" value="editar">
                                        <input type="hidden" name="titulo" value="<?= htmlspecialchars($livro->getTitulo()) ?>">
                                        <button type="submit" class="btn-edit">Editar</button>
                                    </form>

                                    <!-- Botão Deletar -->
                                    <form method="post" style="display:inline;">
                                        <input type="hidden" name="acao" value="deletar">
                                        <input type="hidden" name="titulo" value="<?= htmlspecialchars($livro->getTitulo()) ?>">
                                        <button type="submit" class="btn-delete" onclick="return confirm('Tem certeza que deseja deletar este livro?');">Deletar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="empty-message">Nenhum livro cadastrado.</td></tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</body>
</html>