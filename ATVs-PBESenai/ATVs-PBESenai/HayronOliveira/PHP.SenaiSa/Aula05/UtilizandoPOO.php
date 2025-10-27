<?php

// Criar uma classe simples
class Carro {

    public $Marca;
    public $Modelo;
    public $Ano;
    public $Revisao;
    public $N_donos;    

    // Criando construtor da classe, para associação dos atributos
    public function __construct($Marca, $Modelo, $Ano, $Revisao, $N_donos) {
        $this->Marca = $Marca;
        $this->Modelo = $Modelo;
        $this->Ano = $Ano;
        $this->Revisao = $Revisao;
        $this->N_donos = $N_donos;
    }
}

$carro1 = new Carro("Porsche", "911", 2020, false, 3);

$carro2 = new Carro("Mitsubishi", "Lancer", 1945, true, 1);

$carro3 = new Carro("Honda", "Civic", 2023, false, 1);

$carro4 = new Carro("Chevrolet", "Onix", 2022, true, 2);

$carro5 = new Carro("HRV", "Honda", 2021, false, 1);

$carro6 = new Carro("Jetta", "Volkswagen", 2020, true, 2);
?>