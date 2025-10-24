<?php
// ===================================================================
//                       MODIFICADORES DE ACESSO
// ===================================================================

// *Existem 3 tipos: Public, Private, Protected

// Public NomeDoAtributo: Métodos e atributos públicos

// Private NomeDoAtributo: Métodos e atributos privados para acesso somente dentro da classe, utilizamos os Getters e Setters para acessa-los.

// Protected NomeDoAtributo: métodos e atributos protegidos para acessosomente da classes e de suas classes filhas.

// Pacotes: Sintaxe logo ou no inicio do código, que atribui de onde os arquivos pertence, ou seja, o caminho da pasta em que ele está contido. Exemplo:

// namespace Aula 09;

// Caso tenham mais arquivos que formam o BackEnd de uma página Web e possuem a mesma raiz
// o namespace será o mesmo


namespace Aula09;

interface Pagamento {
    public function pagar($valor);
}

    class CartaoDeCredito implements Pagamento {
        public function pagar($valor){
            echo "Pagamento realizado com cartão de ccrédito, valor $valor\n";
        } 
    }
    class PIX implements Pagamento {
        public function pagar($valor){
            echo "Pagamento realizado com PIX, valor $valor\n";
        } 
    }
    // ATV 1 Criando uma interface simples

interface Forma {
    public function CalcularArea($base, $altura, $raio);
}
    class Quadrado implements Forma {
        public function CalcularArea($base, $altura, $raio){
            $area = $base * $altura;
            echo "A área do quadrado é: $area\n";
        } 
    }
    class Circulo implements Forma {
        public function CalcularArea($base, $altura, $raio){
            $area = 3.14 * ($raio/2) * ($altura/2);
            echo "A área do círculo é: $area\n";
        } 
    }
    class Pentagono implements Forma {
        public function CalcularArea($base, $altura, $raio){
            $area = ($base * $altura) / 2 * 5;

            // Formata o número: 2 casas decimais, vírgula como decimal e ponto como milhar
            $area2 = number_format($area, 2, );

            echo "A área do pentágono é: $area2\n";
        }
    }

// Definição da classe Hexagono
// Ela implementa a interface Forma (supondo que já exista definida em outro lugar)
class Hexagono implements Forma {

    // Método público que calcula a área
    // Recebe o parâmetro $lado (tamanho do lado do hexágono)
    // Os outros parâmetros ($altura e $raio) ficam opcionais (null), 
    // apenas para manter o mesmo padrão de assinatura de métodos de outras formas
    public function CalcularArea($lado, $altura = null, $raio = null){

        $area = (3 * sqrt(3) / 2) * pow($lado, 2);

        $area2 = number_format($area, 2, );

        echo "A área do hexágono é: $area2\n";
    }
}




    
?>