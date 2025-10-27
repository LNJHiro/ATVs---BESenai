
<?php
$nota1 = (float)readline("Nota 1: ");
$nota2 = (float)readline("Nota 2: ");
$presenca = (float)readline("Presença (%): ");

$media = ($nota1 + $nota2) / 2;


echo "Nota 1: $nota1\n";
echo "Nota 2: $nota2\n";
echo "Média: " . number_format($media, 2, ',', '.') . "\n"; // O number_format formata um número definindo casas decimais e os símbolos usados para separar decimais e milhares.
if ($media >= 7 && $presenca >= 75) {
    echo "Aprovado!\n";
    if ($media >= 9) {
        echo "Excelente\n";
    } elseif ($media >= 7) {
        echo "Bom\n";
    }
} else {
    echo "Reprovado!\n";
}
?>