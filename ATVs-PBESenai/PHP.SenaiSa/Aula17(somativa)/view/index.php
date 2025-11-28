<?php
require_once __DIR__ . '/../controller/LivroController.php';

$controller = new LivroController();
$acao = $_POST['acao'] ?? '';
$editarLivro = null;
$termoBusca = $_POST['termo_busca'] ?? '';

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

    // BUSCAR LIVROS
    if ($acao === 'buscar') {
        $lista = $controller->buscar(trim($termoBusca));
        $modoBusca = true;
    }
}

// LER livros cadastrados (apenas se não estiver em modo de busca)
if (!isset($modoBusca)) {
    $lista = $controller->ler();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca Irmã Maria de Santo Inocêncio Lima - Gerenciamento de Livros</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Biblioteca Irmã Maria de Santo Inocêncio Lima</h1>
            <h2>Gerenciamento de Livros</h2>
        </header>

        <hr>
                <!-- FORMULÁRIO DE BUSCA -->
        <div class="search-container">
            <form method="POST" class="search-form">
                <input type="hidden" name="acao" value="buscar">
                <input type="text" name="termo_busca" placeholder="Buscar por título, autor ou gênero..." 
                       value="<?= htmlspecialchars($termoBusca) ?>" required>
                <button type="submit">🔍 Buscar</button>
                <?php if (!empty($termoBusca)): ?>
                    <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn-clear" style="text-decoration: none;">
                        <button type="button">Limpar Busca</button>
                    </a>
                <?php endif; ?>
            </form>
        </div>


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
                        <option value="Literatura Brasileira" <?= $editarLivro->getGeneroLiterario() === 'Literatura Brasileira' ? 'selected' : '' ?>>Literatura Brasileira</option>

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
                        <option value="Lieteratura Brasileira ">Lieteratura Brasileira </option>
                    </select>
                    <input type="text" name="autor" placeholder="Autor do livro:" required>
                    <input type="number" name="ano_publicacao" min="1000" max="<?= date('Y') ?>" placeholder="Ano de Publicação:" required>
                    <input type="number" name="qtde" min="0" placeholder="Quantidade em estoque:" required>
                    <button type="submit">Cadastrar Livro</button>
                </form>
            </div>
        <?php endif; ?>

        <hr>

        <h2>
            <?php if (!empty($termoBusca)): ?>
                Resultados da busca por "<?= htmlspecialchars($termoBusca) ?>"
            <?php else: ?>
                Acervo de Livros
            <?php endif; ?>
        </h2>

        <?php if (!empty($termoBusca)): ?>
            <div class="search-info">
                <?= count($lista) ?> livro(s) encontrado(s)
                | <a href="<?= $_SERVER['PHP_SELF'] ?>" style="color: #4a6491;">Ver todos os livros</a>
            </div>
        <?php endif; ?>

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
                    <tr>
                        <td colspan="6" class="empty-message">
                            <?php if (!empty($termoBusca)): ?>
                                Nenhum livro encontrado para "<?= htmlspecialchars($termoBusca) ?>"
                            <?php else: ?>
                                Nenhum livro cadastrado.
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</body>
</html>