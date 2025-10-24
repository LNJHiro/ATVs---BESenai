<?php

// ==========================
// Definição das Interfaces
// ==========================

interface Movel {
    public function mover();
}

interface Abastecivel {
    public function abastecer($quantidade);
}

interface Manutenivel {
    public function fazerManutencao();
}

// ==========================
// Classe Carro
// ==========================
class Carro implements Movel, Abastecivel {
    public function mover() {
        echo "O carro está se movimentando.\n";
    }

    public function abastecer($quantidade) {
        echo "O carro foi abastecido com $quantidade litros de combustível.\n";
    }
}

// ==========================
// Classe Bicicleta
// ==========================
class Bicicleta implements Movel, Manutenivel {
    public function mover() {
        echo "A bicicleta está pedalando.\n";
    }

    public function fazerManutencao() {
        echo "A bicicleta foi lubrificada.\n";
    }
}

// ==========================
// Classe Ônibus
// ==========================
class Onibus implements Movel, Abastecivel, Manutenivel {
    public function mover() {
        echo "O ônibus está transportando passageiros.\n";
    }

    public function abastecer($quantidade) {
        echo "O ônibus foi abastecido com $quantidade litros de combustível.\n";
    }

    public function fazerManutencao() {
        echo "O ônibus está passando por revisão.\n";
    }
}

// ==========================
// Testando as Classes
// ==========================

$carro = new Carro();
$carro->mover();
$carro->abastecer(40);

echo "-------------------------\n";

$bicicleta = new Bicicleta();
$bicicleta->mover();
$bicicleta->fazerManutencao();

echo "-------------------------\n";

$onibus = new Onibus();
$onibus->mover();
$onibus->abastecer(200);
$onibus->fazerManutencao();
?>

?>