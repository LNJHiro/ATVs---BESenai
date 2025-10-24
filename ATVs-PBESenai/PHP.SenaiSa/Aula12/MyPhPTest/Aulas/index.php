<?php 

require_once "CRUD.php";
require_once "AlunoDAO.php"; // Inlcui outros arquivos php


// Objeto da classe AlunoDAO para gerenciar os métodos do CRUD 

$dao = new AlunoDAO();


// CREATE  

$dao-> criarAluno(new Aluno( 1, "Maria", "Design"));

$dao-> criarAluno (new Aluno(2, "Gabriel", "Moda"));

$dao-> criarAluno (new Aluno(3, "Eduardo", "Manicure"));

// Criando mais 6 objetos 

$dao-> criarAluno (new Aluno(4, "Aurora", "Arquitetura"));

$dao->criarAluno(new Aluno(5, "Oliver", "Director"));

$dao->criarAluno(new Aluno(6, "Amanda", "Lutadora"));

$dao->criarAluno(new Aluno(7, "Geysa", "Engenheira"));

$dao->criarAluno(new Aluno(8, "Joab", "Professor"));

$dao->criarAluno(new Aluno(9, "Bernardo", "Streamer"));


// READ 

echo "\nListagem Inicial: \n";
foreach ($dao->lerAluno() as $aluno) {
    echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()}\n";
    
}


// UPDATE 

$dao->atualizarAluno(3, "Viviane", "Eletricista");

echo "\nApós Atualização: \n";
foreach ($dao->lerAluno() as $aluno) {
    echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()} \n";
}

//========================================
// Exercícios de atualização

//Alterar o nome da Geysa para Clotilde

$dao->atualizarAluno(7, "Clotilde", "Engenheira");

// Alterar o nome do Joab para Joana

$dao->atualizarAluno(8, "Joana", "Professor");

//Alterar o curso do Bernardo para Dev

$dao->atualizarAluno(9, "Bernardo", "Dev");

// Alterar o curso da amanda para Logística

$dao->atualizarAluno(6, "Amanda", "Logística");

// Alterar o curso do Oliver para Eletrica

$dao->atualizarAluno(5, "Oliver", "Elétrica");

echo "\nATV - Atualização: \n";
foreach ($dao->lerAluno() as $aluno) {
    echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()} \n";
}

//========================================

// DELETE 

$dao->excluirAluno(2);

echo "\nApós exclusão\n";
foreach ($dao->lerAluno() as $aluno) {
    echo "{$aluno->getId()} = {$aluno->getNome()} - {$aluno->getCurso()} \n";
}