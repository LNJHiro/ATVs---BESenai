<?php

// =============== EXercício de fixação sobre construtores em PHP  27/08/25 ===============

class moto {

    public $Marca;
    public $Modelo;
    public $Valor;

    public function __construct($Marca, $Modelo, $Valor) {
        $this->Marca = $Marca;
        $this->Modelo = $Modelo;
        $this->Valor = $Valor;
    }
}

$moto1 = new moto("Honda", "CG 160", 15000);

$moto2 = new moto("Royal Enfield", "Meteor 350", 25000);

$moto3 = new moto("Harley Davidson", "FAT BOB™ 114",   82.900);   

// // ===============================
// // 1° Construtor: Data
// // ===============================
// class Data {
//     public $dia;
//     public $mes;
//     public $ano;

//     // Construtor recebendo 3 parâmetros
//     public function __construct($dia, $mes, $ano) {
//         $this->dia = $dia;
//         $this->mes = $mes;
//         $this->ano = $ano;
//     }

//     public function exibirData() {
//         return "$this->dia/$this->mes/$this->ano";
//     }
// }

// // ===============================
// // 2° Construtor: Pessoa
// // ===============================
// class Pessoa {
//     public $nome;
//     public $idade;
//     public $cpf;
//     public $telefone;
//     public $endereco;
//     public $estado_civil;
//     public $sexo;

//     // Construtor recebendo 7 parâmetros
//     public function __construct($nome, $idade, $cpf, $telefone, $endereco, $estado_civil, $sexo) {
//         $this->nome = $nome;
//         $this->idade = $idade;
//         $this->cpf = $cpf;
//         $this->telefone = $telefone;
//         $this->endereco = $endereco;
//         $this->estado_civil = $estado_civil;
//         $this->sexo = $sexo;
//     }

//     public function exibirPessoa() {
//         return "Nome: $this->nome | Idade: $this->idade | CPF: $this->cpf | Telefone: $this->telefone | Endereço: $this->endereco | Estado Civil: $this->estado_civil | Sexo: $this->sexo";
//     }
// }

// // ===============================
// // 3° Construtor: Produto
// // ===============================
// class Produto {
//     public $marca;
//     public $nome;
//     public $categoria;
//     public $data_fabricacao;
//     public $data_venda;

//     // Construtor recebendo 5 parâmetros
//     public function __construct($marca, $nome, $categoria, $data_fabricacao, $data_venda) {
//         $this->marca = $marca;
//         $this->nome = $nome;
//         $this->categoria = $categoria;
//         $this->data_fabricacao = $data_fabricacao;
//         $this->data_venda = $data_venda;
//     }

//     public function exibirProduto() {
//         return "Produto: $this->nome | Marca: $this->marca | Categoria: $this->categoria | Fabricação: $this->data_fabricacao | Venda: $this->data_venda";
//     }
// }
?>