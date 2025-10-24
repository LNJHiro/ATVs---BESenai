<!-- exercício 01 -->

<?php

namespace exFormasGeometricas;

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
    class Retangulo implements Forma {
        public function CalcularArea($base, $altura, $raio){
            $area = ($base * $altura);

            // Formata o número: 2 casas decimais, vírgula como decimal e ponto como milhar
            $area2 = number_format($area, 2, ',', '.');
            echo "A área do retângulo é: $area2\n";
        } 
    }

    // ===== Criando objetos de teste =====
    $quadrado = new Quadrado();
    $circulo = new Circulo();
    $Retangulo = new Retangulo();

    // Testando individualmente
    echo "=== Testando objetos individualmente ===\n";
    $quadrado->CalcularArea(5, 5, 0); // Base e altura para quadrado
    $circulo->CalcularArea(0, 10, 10); // Raio para círculo
    $Retangulo->CalcularArea(6, 4, 0); // Base e altura para retângulo
?>



