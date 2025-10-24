<?php

      $ModeloCarro1 = "versa";
      $MarcaCarro1 = "Nissan";
      $AnoCarro1 = "2020";
      $RevisaoCarro1 = "true";
      $NdonosCarro1 = 2;
      
      $ModeloCarro2 = "M5";
      $MarcaCarro2 = "BMW";
      $AnoCarro2 = "2018";
      $RevisaoCarro2 = "false";
      $NdonosCarro2 = 2;

      
      $ModeloCarro3 = "911";
      $MarcaCarro3 = "porsche";
      $AnoCarro3 = "2026";
      $RevisaoCarro3 = false;
      $NdonosCarro3 = 1;
      
      $ModeloCarro4 = "Dolphin";
      $MarcaCarro4 = "BYD";
      $AnoCarro4 = "2023";
      $RevisaoCarro4 = false;
      $NdonosCarro4 = 1;

      function PassouRevisao ($revisaoF) {
          $revisaoF = false;
          return $revisaoF;
}

$RevisaoCarro4 = PassouRevisao($RevisaoCarro4);

function NovoDono($donos) {
    $donos++;
    return $donos;
}

$NdonosCarro4 = NovoDono($NdonosCarro4);

// Função para exibir informações de um carro
function exibirCarro($modelo, $marca, $ano, $revisao, $Ndonos) {
    // Verifica se o carro passou por revisão e define a string correspondente
    $revisaoStr = ($revisao === true || $revisao === "true") ? "Sim" : "Não";
    // Exibe as informações do carro formatadas
    echo "O carro {$marca} {$modelo}, ano {$ano}, já passou por revisão: {$revisaoStr}, número de donos: {$Ndonos} n/";
}

exibirCarro($ModeloCarro4, $MarcaCarro4, $AnoCarro4, $RevisaoCarro4, $NdonosCarro4);

exibirCarro($ModeloCarro3, $MarcaCarro3, $AnoCarro3, $RevisaoCarro3, $NdonosCarro3);

exibirCarro($ModeloCarro2, $MarcaCarro2, $AnoCarro2, $RevisaoCarro2, $NdonosCarro2);

exibirCarro($ModeloCarro1, $MarcaCarro1, $AnoCarro1, $RevisaoCarro1, $NdonosCarro1);


// Função para ver se o carro é semi novo
function ehSeminovo($ano) {
    $AnoAtual = (int)(readline("Digite o ano atual: "));
    return ($AnoAtual - $ano <= 3);
}

ehSeminovo($AnoCarro4);
ehSeminovo($AnoCarro3);
ehSeminovo($AnoCarro2);
ehSeminovo($AnoCarro1);

echo"O carro $ModeloCarro1 é seminovo? " . (ehSeminovo($AnoCarro1) ? "true" : "false");

echo"O carro $ModeloCarro2 é seminovo? " . (ehSeminovo($AnoCarro2) ? "true" : "false");

echo"O carro $ModeloCarro3 é seminovo? " . (ehSeminovo($AnoCarro3) ? "true" : "false");

echo"O carro $ModeloCarro4 é seminovo? " . (ehSeminovo($AnoCarro4) ? "true" : "false");


function precisaRevisao($revisao, $ano) {
    if (($revisao === false || $revisao === "false") && (int)$ano < 2022) {
        return "Precisa de revisão";
    } else {
        return "Revisão em dia";
    }
}

function calcularValor($marca, $ano, $Ndonos) {
    // Define preço base conforme a marca
    switch (strtolower($marca)) {
        case 'bmw':
        case 'porsche':
            $precoBase = 300000;
            break;
        case 'nissan':
            $precoBase = 70000;
            break;
        case 'byd':
            $precoBase = 150000;
            break;
    }

    // Calcula o desconto pelo número de donos
    if ($Ndonos > 1) {
        $precoBase *= pow(0.95, $Ndonos - 1); // pow(a, b) é “a elevado a b”.
    }

    // Calcula desconto por ano de uso
    $anoAtual = (int)date('Y');
    $anosUso = $anoAtual - (int)$ano;
    if ($anosUso > 0) {
        $precoBase -= $anosUso * 3000;
    }

    // Garante que o valor não fique negativo
    return max($precoBase, 0);
}

// Imprime o valor estimado para cada carro
echo "Valor estimado do $MarcaCarro1 $ModeloCarro1: R$ " . number_format(calcularValor($MarcaCarro1, $AnoCarro1, $NdonosCarro1), 2, ',', '.') . "<br>";
echo "Valor estimado do $MarcaCarro2 $ModeloCarro2: R$ " . number_format(calcularValor($MarcaCarro2, $AnoCarro2, $NdonosCarro2), 2, ',', '.') . "<br>";
echo "Valor estimado do $MarcaCarro3 $ModeloCarro3: R$ " . number_format(calcularValor($MarcaCarro3, $AnoCarro3, $NdonosCarro3), 2, ',', '.') . "<br>";
echo "Valor estimado do $MarcaCarro4 $ModeloCarro4: R$ " . number_format(calcularValor($MarcaCarro4, $AnoCarro4, $NdonosCarro4), 2, ',', '.') . "<br>";
?>
