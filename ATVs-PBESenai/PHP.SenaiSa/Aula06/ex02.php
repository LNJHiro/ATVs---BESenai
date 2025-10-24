<?php

// =================================================================
// Lista de exercícios – Métodos e construtores
// (continuação dos exercícios de criação de classes e  objetos)
// =================================================================

// ----------------------------ATV 5--------------------------------
class Cachorro {
    // Atributo
    public $nome;

    // Construtor para inicializar o nome
    public function __construct($nome) {
        $this->nome = $nome;
    }

    // Método latir
    public function latir() {
        echo "O cachorro {$this->nome} está latindo!\n";
    }
}

// Exemplo de uso
$c1 = new Cachorro("Rex");
$c1->latir();

$c2 = new Cachorro("Bob");
$c2->latir();

// ----------------------------ATV 6--------------------------------

// class Cachorro {
//     public $nome;
//     public $raca;

//     public function __construct($nome, $raca) {
//         $this->nome = $nome;
//         $this->raca = $raca;
//     }

//     public function latir() {
//         echo "O cachorro {$this->nome} está latindo!\n";
//     }

//     public function marcarTerritorio() {
//         echo "O cachorro {$this->nome} da raça {$this->raca} está marcando território!\n";
//     }
// }

// // Exemplo de uso
// $c1 = new Cachorro("Rex", "Pastor Alemão");
// $c1->latir();
// $c1->marcarTerritorio();

// ----------------------------ATV 7--------------------------------

class Usuarios {
    public $nome;
    public $sexo; // "Masculino" ou "Feminino"

    public function __construct($nome, $sexo) {
        $this->nome = $nome;
        $this->sexo = strtolower($sexo); // força para minúsculo
    }

    public function testandoReservista() {
        if ($this->sexo === "masculino") {
            echo "Apresente seu certificado de reservista do tiro de guerra!\n";
        } else {
            echo "Tudo certo.\n";
        }
    }
}

// Exemplo de uso
$u1 = new Usuarios("João", "Masculino");
$u1->testandoReservista();

$u2 = new Usuarios("Maria", "Feminino");
$u2->testandoReservista();

// ----------------------------ATV 8--------------------------------

// class Usuarios {
//     public $nome;
//     public $estado_civil;

//     public function __construct($nome, $estado_civil) {
//         $this->nome = $nome;
//         $this->estado_civil = strtolower($estado_civil);
//     }

//     public function casamento($anos_casado) {
//         if ($this->estado_civil === "casado") {
//             echo "Parabéns pelo seu casamento de {$anos_casado} anos, {$this->nome}!\n";
//         } else {
//             echo "Oloco, {$this->nome}!\n";
//         }
//     }
// }

// // Exemplo de uso
// $u3 = new Usuarios("Carlos", "Casado");
// $u3->casamento(10);

// $u4 = new Usuarios("Ana", "Solteira");
// $u4->casamento(0);

?>
