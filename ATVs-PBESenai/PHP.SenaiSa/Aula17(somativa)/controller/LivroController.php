<?php
require_once __DIR__ . '/../Model/LivroDAO.php';
require_once __DIR__ . '/../Model/Livro.php';

class LivroController {
    private $dao;

    // Construtor: cria o objeto DAO (responsável por salvar/carregar)
    public function __construct() {
        $this->dao = new LivroDAO();
    }

    // Lista todas as livros
   public function criar($titulo, $genero_literario, $autor, $ano_publicacao, $qtde) {
    // Verifica se já existe
    $livroExistente = $this->dao->buscarPorTitulo($titulo);
    
    if ($livroExistente) {
        throw new Exception("❌ Já existe um livro cadastrado com o título: '$titulo'");
    }

    // Validações adicionais (opcional)
    if (empty($titulo) || empty($autor)) {
        throw new Exception("❌ Título e autor são obrigatórios");
    }

    if ($ano_publicacao > date('Y')) {
        throw new Exception("❌ Ano de publicação não pode ser no futuro");
    }

    $livro = new Livro($titulo, $genero_literario, $autor, $ano_publicacao, $qtde);
    $this->dao->criarLivro($livro);


        // // Gera ID automaticamente
        // $id = time(); // Função caso o objeto tenha um atributo de ID

        $livro = new Livro( $titulo, $genero_literario, $autor, $ano_publicacao, $qtde);
        $this->dao->criarLivro($livro);
    } 
    
    public function ler() {
        return $this->dao->lerLivros();
    }
  
public function atualizar($tituloOriginal, $novoTitulo, $genero_literario, $autor, $ano_publicacao, $qtde) {
    $this->dao->atualizarLivro($tituloOriginal, $novoTitulo, $genero_literario, $autor, $ano_publicacao, $qtde);
}

public function buscarPorTitulo($titulo) {
    return $this->dao->buscarPorTitulo($titulo);
}
    // Exclui livro
    public function deletar($titulo) {
        $this->dao->excluirLivro($titulo);
    }
// Buscar livros por termo
public function buscar($termo) {
    return $this->dao->buscarLivros($termo);
}

}

