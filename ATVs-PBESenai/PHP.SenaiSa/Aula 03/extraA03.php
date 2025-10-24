<?php
// Lê dois valores do usuário
$Vone = strtolower(readline("Digite o primeiro valor: "));
$Vtwo = strtolower(readline("Digite o segundo valor: "));

// Filtro detalhado para o primeiro valor
if ($Vone === '') {
    $tipo1 = 'string vazia';
} elseif (is_numeric($Vone)) {
    $tipo1 = (strpos($Vone, '.') !== false) ? 'float' : 'integer';
} elseif ($Vone === 'true' || $Vone === 'false') {
    $tipo1 = 'boolean';
} elseif (is_null($Vone)) {
    $tipo1 = 'null';
} else {
    $tipo1 = 'string';
}
echo "O primeiro valor é do tipo: $tipo1.\n";

// Filtro detalhado para o segundo valor
if ($Vtwo === '') {
    $tipo2 = 'string vazia';
} elseif (is_numeric($Vtwo)) {
    $tipo2 = (strpos($Vtwo, '.') !== false) ? 'float' : 'integer';
} elseif ($Vtwo === 'true' || $Vtwo === 'false') {
    $tipo2 = 'boolean';
} elseif (is_null($Vtwo)) {
    $tipo2 = 'null';
} else {
    $tipo2 = 'string';
}
echo "O segundo valor é do tipo: $tipo2.\n";

// Exibe a mensagem conforme os tipos
if ($tipo1 === $tipo2) {
    echo "Variáveis de tipos iguais! Primeiro valor do tipo $tipo1 e segundo valor do tipo $tipo2\n";
} else {
    echo "ERRO! Variáveis de tipos diferentes. Primeiro valor do tipo $tipo1 e segundo valor do tipo $tipo2\n";
}
