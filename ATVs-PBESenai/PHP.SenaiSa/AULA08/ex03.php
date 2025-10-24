<?php
// ===================================================================
//                        ATV 3 - CLASSE NOTAS
// ===================================================================
class Aluno {
    // Atributos privados
    private $nome;
    private $nota;

    // Construtor opcional para inicializar o nome e a nota
    public function __construct($nome, $nota) {
        $this->setNome($nome);
        $this->setNota($nota);
    }

    // ======== SETTERS ========
    public function setNome($nome) {
        $this->nome = ucfirst(strtolower($nome)); // Primeira letra maiúscula
    }

    public function setNota($nota) {
        // Verifica se a nota está entre 0 e 10
        if ($nota >= 0 && $nota <= 10) {
            $this->nota = $nota;
        } else {
            // Nota inválida → armazena 0
            $this->nota = 0;
        }
    }

    // ======== GETTERS ========
    public function getNome() {
        return $this->nome;
    }

    public function getNota() {
        return $this->nota;
    }
}

// ======== TESTE ========

// Alunos com notas válidas
$aluno1 = new Aluno("João", 8);
$aluno2 = new Aluno("Maria", 10);

// Aluno com nota inválida
$aluno3 = new Aluno("Pedro", 15); // Nota > 10, deve armazenar 0

// Exibindo resultados
echo $aluno1->getNome() . " - Nota: " . $aluno1->getNota() . "\n";
echo $aluno2->getNome() . " - Nota: " . $aluno2->getNota() . "\n";
echo $aluno3->getNome() . " - Nota: " . $aluno3->getNota() . "\n";

?>
