<?php
$temperatura = readline("Digite a temperatura em °C: ");

// Verifica em qual faixa a temperatura se encaixa
if ($temperatura < 15) {
    echo "Frio\n";
} elseif ($temperatura <= 25) {
    echo "Agradável\n";
} else {
    echo "Quente\n";
}
?>
