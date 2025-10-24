<?php
// ===================================================================
//                        ATV 5 - CLASSE FUNCIONARIO
// ===================================================================
class Funcionario {
    // Atributos privados
    private $nome;
    private $salario;

    // ======== SETTERS ========
    public function setNome($nome) {
        $this->nome = ucfirst(strtolower($nome)); // Primeira letra maiúscula
    }

    public function setSalario($salario) {
        // Garantir que o salário seja positivo
        if ($salario >= 0) {
            $this->salario = $salario;
        } else {
            $this->salario = 0;
        }
    }

    // ======== GETTERS ========
    public function getNome() {
        return $this->nome;
    }

    public function getSalario() {
        return $this->salario;
    }
}

// ======== TESTE DO OBJETO ========

// Criando um funcionário
$func = new Funcionario();

// Definindo valores iniciais
$func->setNome("Carlos");
$func->setSalario(2500);

// Exibindo os valores iniciais
echo "Funcionário: " . $func->getNome() . " - Salário: R$ " . $func->getSalario() . "\n";

// ======== ALTERANDO DADOS ========

// Modificando nome e salário
$func->setNome("Roberta");
$func->setSalario(3200);

// Exibindo os valores modificados
echo "Funcionário: " . $func->getNome() . " - Salário: R$ " . $func->getSalario() . "\n";

?>
