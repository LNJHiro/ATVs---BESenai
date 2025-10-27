<?php
// Solicita o número para o usuário
$numero = readline("Digite um número: ");

// Laço de 1 a 10 para exibir a tabuada
for ($i = 1; $i <= 10; $i++) {
    $resultado = $numero * $i;
    echo "$numero x $i = $resultado\n";
}
?>
