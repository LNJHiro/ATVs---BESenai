<?php
// Repetir o menu 5 vezes
for ($i = 0; $i < 5; $i++) {
    // Exibe o menu
    echo "1 - Olá\n";
    echo "2 - Data Atual\n";
    echo "3 - Sair\n";

    // Pede a opção ao usuário
    $opcao = readline("Escolha uma opção: ");

    // Executa a ação de acordo com a opção
    switch ($opcao) {
        case "1":
            echo "Olá!\n";
            break;
        case "2":
            echo "Data Atual: " . date("d/m/Y") . "\n";
            break;
        case "3":
            echo "Saindo...\n";
            // Interrompe o for se o usuário escolher sair
            break 2; // Sai do switch e do for
        default:
            echo "Opção inválida!\n";
    }

    echo "\n"; // Espaço entre as repetições
}
?>
