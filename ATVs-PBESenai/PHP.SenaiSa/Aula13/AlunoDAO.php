<?php

require_once 'CRUD.php'; // importante para ter acesso à classe Aluno

class AlunoDAO { // DAO = "Data Access Object"

    private $alunos = []; // Array para armazenar temporariamente os objetos
    private $arquivo = "alunos.json"; // Corrigido: faltava ponto e vírgula

    // Construtor: carrega os dados do arquivo JSON ao iniciar a aplicação
    public function __construct() { 
        if (file_exists($this->arquivo)) {
            $conteudo = file_get_contents($this->arquivo);  
            $dados = json_decode($conteudo, true); // Converte JSON em array associativo

            if ($dados) {
                foreach ($dados as $id => $info) {
                    $this->alunos[$id] = new Aluno(
                        $info['id'],
                        $info['nome'],
                        $info['curso']
                    );
                }
            }
        }
    }

    // Função privada para salvar os dados no arquivo JSON
    private function salvarEmArquivo() {
        $dados = [];

        foreach ($this->alunos as $id => $aluno) {
            $dados[$id] = [
                'id' => $aluno->getId(),
                'nome' => $aluno->getNome(),
                'curso' => $aluno->getCurso() // Corrigido erro de digitação
            ];
        }

        file_put_contents($this->arquivo, json_encode($dados, JSON_PRETTY_PRINT));
    }

    // CREATE
    public function criarAluno(Aluno $aluno) {
        $this->alunos[$aluno->getId()] = $aluno;
        $this->salvarEmArquivo();
    }

    // READ
    public function lerAluno() {
        return $this->alunos;
    }

    // UPDATE
    public function atualizarAluno($id, $novoNome, $novoCurso) {
        if (isset($this->alunos[$id])) {
            $this->alunos[$id]->setNome($novoNome);
            $this->alunos[$id]->setCurso($novoCurso);
            $this->salvarEmArquivo();
        }
    }

    // DELETE
    public function excluirAluno($id) {
        if (isset($this->alunos[$id])) {
            unset($this->alunos[$id]);
            $this->salvarEmArquivo();
        }
    }
}

?>
