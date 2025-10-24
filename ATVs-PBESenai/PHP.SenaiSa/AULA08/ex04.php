<?php
// ===================================================================
//                        ATV 3 - CLASSE PRODUTO
// ===================================================================
class Produto {
    // Atributos privados
    private $nome;
    private $preco;
    private $estoque;

    // ======== SETTERS ========
    public function setNome($nome) {
        $this->nome = ucfirst(strtolower($nome)); // Primeira letra maiúscula
    }

    public function setPreco($preco) {
        // Verifica se o preço é positivo
        if ($preco >= 0) {
            $this->preco = $preco;
        } else {
            $this->preco = 0;
        }
    }

    public function setEstoque($estoque) {
        // Verifica se o estoque é maior ou igual a zero
        if ($estoque >= 0) {
            $this->estoque = $estoque;
        } else {
            $this->estoque = 0;
        }
    }

    // ======== GETTERS ========
    public function getNome() {
        return $this->nome;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function getEstoque() {
        return $this->estoque;
    }
}

// ======== TESTE DO OBJETO ========

// Criando um produto
$produto1 = new Produto();

// Definindo os valores usando setters
$produto1->setNome("Notebook");
$produto1->setPreco(3500.50);
$produto1->setEstoque(12);

// Exibindo informações com getters
echo "O produto " . $produto1->getNome() . " custa R$ " . $produto1->getPreco() .
     " e possui " . $produto1->getEstoque() . " unidades em estoque.\n";

?>
