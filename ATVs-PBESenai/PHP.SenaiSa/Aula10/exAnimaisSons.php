<!-- exercício 02 -->

<?php

// Classe pai Animal
class Animal {
    // Método que será sobrescrito pelas subclasses
    public function fazerSom() {
        echo "Som qualquer de animal\n";
    }
}

// Subclasse Cachorro
class Cachorro extends Animal {
    public function fazerSom() {
        echo "Au au!\n";
    }
}

// Subclasse Gato
class Gato extends Animal {
    public function fazerSom() {
        echo "Miau!\n";
    }
}

// Subclasse Vaca
class Vaca extends Animal {
    public function fazerSom() {
        echo "Muuu!\n";
    }
}

// ===== Testando os objetos =====
$cachorro = new Cachorro();
$gato = new Gato();
$vaca = new Vaca();

// Chamando o método fazerSom de cada objeto
$cachorro->fazerSom(); 
$gato->fazerSom();     
$vaca->fazerSom();     
