<?php 
// ===================================================================
//                        ATV 1 - CLASSE CARRO
// ===================================================================

// ======== DEFINIÇÃO DA CLASSE ========
class Carro {
    // ======== ATRIBUTOS PRIVADOS ========
    private $marca;   // Armazena a marca do carro (acesso apenas dentro da classe)
    private $modelo;  // Armazena o modelo do carro (acesso apenas dentro da classe)

    // ======== SETTERS ========
    // Método para definir a marca
    public function setMarca($marca) {
        // Converte toda a string para minúsculas e deixa a primeira letra maiúscula
        $this->marca = ucfirst(strtolower($marca)); 
    }

    // Método para definir o modelo
    public function setModelo($modelo) {
        // Converte toda a string para minúsculas e deixa a primeira letra maiúscula
        $this->modelo = ucfirst(strtolower($modelo));
    }

    // ======== GETTERS ========
    // Método para retornar a marca
    public function getMarca() {
        return $this->marca;
    }

    // Método para retornar o modelo
    public function getModelo() {
        return $this->modelo;
    }

    // ======== CONSTRUTOR ========
    // Executado automaticamente ao criar um objeto da classe
    public function __construct($marca, $modelo) {
        // Chama os setters para definir os valores iniciais com tratamento
        $this->setMarca($marca);
        $this->setModelo($modelo);
    }
}

// ======== CRIAÇÃO DE UM OBJETO ========
// Cria um carro chamado $carro1 com marca "toyota" e modelo "corolla"
$carro1 = new Carro("toyota", "corolla");

// ======== EXIBINDO VALORES COM GETTERS ========
// Mostra a marca do carro usando o getter
echo "A marca do carro é: " . $carro1->getMarca() . "\n";

// Mostra o modelo do carro usando o getter
echo "O modelo do carro é: " . $carro1->getModelo();

?>
