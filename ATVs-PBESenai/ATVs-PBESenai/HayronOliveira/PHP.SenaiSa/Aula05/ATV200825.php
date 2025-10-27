<?php

// Inclui a classe Jogos ATV 1

class Jogos {

    public $Nome;
    public $Preco;
    public $Tipo;
    public $AnoLancamento;
    public $Marca;  

    public function __construct($Nome, $Preco, $Tipo, $AnoLancamento, $Marca) {
        $this->Nome = $Nome;
        $this->Preco = $Preco;
        $this->Tipo = $Tipo;
        $this->AnoLancamento = $AnoLancamento;
        $this->Marca = $Marca;
    }
}

$Jogo1 = new Jogos("Dandara", 50, "Metroidvania", 2018, "Raw Fury");

$Jogo2 = new Jogos("The Last of Us Part II", 180, "Ação/Aventura", 2020, "Naughty Dog");

$Jogo3 = new Jogos("Hollow Knight", 80, "Metroidvania", 2017, "Team Cherry");

$Jogo4 = new Jogos("Castlevania: Symphony of the Night", 40, "Ação/Plataforma", 1997, "Konami");

// ATV 2

class cachorro{

    public $Nome;
    public $Raca;
    public $Idade;



    public function __construct($Nome, $Raca, $Idade) {
        $this->Nome = $Nome;
        $this->Raca = $Raca;
        $this->Idade = $Idade;

    }
}

$cachorro1 = new cachorro("Rex", "Labrador", 3);
$cachorro2 = new cachorro("Bella", "Poodle", 2);
$cachorro3 = new cachorro("Thor", "Bulldog", 4);
$cachorro4 = new cachorro("Luna", "Beagle", 1);
$cachorro5 = new cachorro("Max", "Pastor Alemão", 5);
$cachorro6 = new cachorro("Mel", "Shih Tzu", 2);
$cachorro7 = new cachorro("Bob", "Golden Retriever", 6);
$cachorro8 = new cachorro("Nina", "Dálmata", 3);
$cachorro9 = new cachorro("Toby", "Boxer", 4);
$cachorro10 = new cachorro("Maggie", "Schnauzer", 2);

class Usuario {

    public $Nome;
    public $CPF;
    public $Sexo;  
    public $Email;
    public $EstadoCivil;
    public $Cidade;
    public $Estado;
    public $Endereco;
    public $Cep;
    
    public function __construct($Nome, $CPF, $Sexo, $Email, $EstadoCivil, $Cidade, $Estado, $Endereco, $Cep) {
        $this->Nome = $Nome;
        $this->CPF = $CPF;
        $this->Sexo = $Sexo;
        $this->Email = $Email;
        $this->EstadoCivil = $EstadoCivil;
        $this->Cidade = $Cidade;
        $this->Estado = $Estado;
        $this->Endereco = $Endereco;
        $this->Cep = $Cep;
    }
}

$Usuario1 = new Usuario("Josenildo Afonso Souza", "100.200.300-40", "Masculino", "josenewdo.souza@gmail.com",
    "Casado", "Xique-Xique", "Bahia", "Rua da amizade, 99", "40123-98");

$Usuario2 = new Usuario("Valentina Passos Scherrer", "070.070.060-70", "Feminino", "scherrer.valen@outlook.com",
    "Divorciada", "Iracemápolis", "São Paulo", "Avenida da saudade, 1942", "23456-24");

$Usuario3 = new Usuario("Claudio Braz Nepumoceno", "575.575.242-32", "Masculino", "Clauclau.nepumoceno@gmail.com",
    "Solteiro", "Piripiri", "Piauí", "Estrada 3, 33", "12345-99");
?>
