<?php
// Entrada do nome e idade
$nome = readline("Nome: ");
$idade = readline("Idade: ");

// Verifica se algum campo está vazio
if ($nome === "" || $idade === "") {
    echo "Por favor, preencha todos os campos.\n";
} else {
    echo "Nome: $nome, Idade: $idade\n";

    // Verifica se é maior ou menor de idade
    if ($idade >= 18) {
        echo "Você, $nome, é maior de idade.\n";
    } else {
        echo "Você, $nome, é menor de idade.\n";
    }
}
?>
