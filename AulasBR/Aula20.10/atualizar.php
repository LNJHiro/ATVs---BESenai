<?php 

$conn = new mysqli("localhost","root","SenaiSp","ReservaEquipamentos");

$CPF = $_POST['CPF'];
$NOME = $_POST['nome'];     
$EMAIL = $_POST['email'];

$sql = "UPDATE cliente_novo SET nome='$NOME', email='$EMAIL' WHERE CPF='$CPF'";

if ($conn->query($sql) === TRUE) {
    echo "Registro atualizado com sucesso!";
    echo "</br>
    <a href='index.php'>
    <button type='button'>Voltar
    </button>
    </a>";
} else {
    echo "Erro: " . $conn->error;
}

$conn->close();

?>