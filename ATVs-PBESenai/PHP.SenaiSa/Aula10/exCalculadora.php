<!-- EXERCÍCIO -->

<?php 

class Calculadora {

    // Método somar com 2 parâmetros obrigatórios e 1 opcional
    public function somar($a, $b, $c = null) {
        if ($c !== null) {
            // Se $c foi passado, soma os três números
            return $a + $b + $c;
        } else {
            // Caso contrário, soma apenas os dois primeiros
            return $a + $b;
        }
    }
}

// ===== Testando =====
$calc = new Calculadora();

echo "Soma de 2 números (2 + 3): " . $calc->somar(2, 3) . "\n";
echo "Soma de 3 números (2 + 3 + 4): " . $calc->somar(2, 3, 4) . "\n"; 
echo "10 + 15: " . $calc->somar(10, 15) . "\n"; 
?>