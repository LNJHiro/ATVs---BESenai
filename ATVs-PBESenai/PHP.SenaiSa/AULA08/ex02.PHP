<?php 
// ===================================================================
//                        ATV 2 - CLASSE PESSOA
// ===================================================================
class Pessoa {
    private $nome;
    private $idade;
    private $email;

    // Construtor para inicializar os atributos
    public function __construct($nome, $idade, $email) {
        $this->setNome($nome);
        $this->setIdade($idade);
        $this->setEmail($email);
    }

    // ======== SETTERS =========
    public function setNome($nome) {
        // deixa a primeira letra de cada nome em maiúsculo
        $this->nome = ucwords(strtolower($nome));
    }

    public function setIdade($idade) {
        // garante que seja um número inteiro positivo
        $this->idade = abs((int)$idade);
    }

    public function setEmail($email) {
        // transforma em minúsculo para padronizar
        $this->email = strtolower($email);
    }

    // ======== GETTERS =========
    public function getNome() {
        return $this->nome;
    }

    public function getIdade() {
        return $this->idade;
    }

    public function getEmail() {
        return $this->email;
    }

    // ======== MÉTODO PARA EXIBIR INFORMAÇÕES =========
    public function ExibirInfo() {
        return "O nome é {$this->getNome()}, tem {$this->getIdade()} anos e o email é {$this->getEmail()}.";
    }
}

// Criando objeto Pessoa
$pessoa1 = new Pessoa("HIRO", 19, "teste@exemplo.com");

// Exibindo os dados formatados
echo $pessoa1->ExibirInfo();

?>
