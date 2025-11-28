<?php
require_once 'Livro.php';
require_once 'Connection.php';

class LivroDAO {
    private $conn;

    public function __construct() {
        $this->conn = Connection::getInstance();

        // Cria a tabela se não existir
        $this->conn->exec("
            CREATE TABLE IF NOT EXISTS livros (
                id INT AUTO_INCREMENT PRIMARY KEY,
                titulo VARCHAR(100) NOT NULL UNIQUE,
                genero_literario VARCHAR(50) NOT NULL,
                autor VARCHAR(20) NOT NULL,
                ano_publicacao DECIMAL(10,2) NOT NULL,
                qtde INT NOT NULL
            )
        ");
    }
    

    // CREATE
    public function criarLivro(Livro $livro) {
        $stmt = $this->conn->prepare("
            INSERT INTO livros (titulo, genero_literario, autor, ano_publicacao, qtde)
            VALUES (:titulo, :genero_literario, :autor, :ano_publicacao, :qtde)
        ");
        $stmt->execute([
            ':titulo' => $livro->getTitulo(),
            ':genero_literario' => $livro->getGeneroLiterario(),
            ':autor' => $livro->getAutor(),
            ':ano_publicacao' => $livro->getAnoPublicacao(),
            ':qtde' => $livro->getQtde()
        ]);
    }

    // READ
    public function lerLivros() {
        $stmt = $this->conn->query("SELECT * FROM livros ORDER BY titulo");
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Livro(
                $row['titulo'],
                $row['genero_literario'],
                $row['autor'],
                $row['ano_publicacao'],
                $row['qtde']
            );
        }
        return $result;
    }

    // UPDATE
    public function atualizarLivro($tituloOriginal, $novoTitulo, $genero_literario, $autor, $ano_publicacao, $qtde) {
        $stmt = $this->conn->prepare("
            UPDATE livros
            SET titulo = :novoTitulo, genero_literario = :genero_literario, autor = :autor, ano_publicacao = :ano_publicacao, qtde = :qtde
            WHERE titulo = :tituloOriginal
        ");
        $stmt->execute([
            ':novoTitulo' => $novoTitulo,
            ':genero_literario' => $genero_literario,
            ':autor' => $autor,
            ':ano_publicacao' => $ano_publicacao,
            ':qtde' => $qtde,
            ':tituloOriginal' => $tituloOriginal
        ]);
    }

    // DELETE
    public function excluirLivro($titulo) {
        $stmt = $this->conn->prepare("DELETE FROM livros WHERE titulo = :titulo");
        $stmt->execute([':titulo' => $titulo]);
    }

    // BUSCAR POR NOME
    public function buscarPorTitulo($titulo) {
        $stmt = $this->conn->prepare("SELECT * FROM livros WHERE titulo = :titulo LIMIT 1");
        $stmt->execute([':titulo' => $titulo]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Livro(
                $row['titulo'],
                $row['genero_literario'],
                $row['autor'],
                $row['ano_publicacao'],
                $row['qtde']
            );
        }
        return null;
    }
    public function buscarLivros($termo) {
    $stmt = $this->conn->prepare("
        SELECT * FROM livros 
        WHERE titulo LIKE :termo 
           OR autor LIKE :termo 
           OR genero_literario LIKE :termo
        ORDER BY titulo
    ");
    $stmt->execute([':termo' => '%' . $termo . '%']);
    
    $result = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $result[] = new Livro(
            $row['titulo'],
            $row['genero_literario'],
            $row['autor'],
            $row['ano_publicacao'],
            $row['qtde']
        );
    }
    return $result;
}
}