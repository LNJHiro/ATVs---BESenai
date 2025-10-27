<?php
// Pergunta o primeiro número
echo "Digite o primeiro número: ";
// fgets(STDIN) lê o que o usuário digita no terminal (com ENTER)
// trim() tira espaços e quebras de linha do começo e do fim
$num1 = trim(fgets(STDIN));

echo "Digite o segundo número: ";
$num2 = trim(fgets(STDIN));

echo "Digite a operação (+, -, *, /): ";
$op = trim(fgets(STDIN)); // op de operação

// Faz a operação conforme o símbolo digitado
switch ($op) {
    case '+':
        echo $num1 + $num2;
        break;
    case '-':
        echo $num1 - $num2;
        break;
    case '*':
        echo $num1 * $num2;
        break;
    case '/':
        // Verifica se o segundo número é diferente de zero para evitar cagada
        if ($num2 != 0) {
            echo $num1 / $num2;
        } else {
            echo "Erro: não pode dividir por zero!";
        }
        break;
    default:
        echo "Operação inválida!";
}
?>
