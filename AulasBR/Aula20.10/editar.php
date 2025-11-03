<?php

$conn = new mysqli("localhost", "root", "SenaiSp", "ReservaEquipamentos");

$CPF = $_GET['CPF'];

$result = $conn->query("SELECT * FROM cliente_novo WHERE CPF = '$CPF'");

$row = $result -> fetch_assoc();
?>

<form action="atualizar.php" method="POST"> 

    <input type="hidden" name="CPF" value="<?php echo $row['CPF']; ?>">
    Nome: <input type="text" name="nome" value="<?php echo $row['NOME']; ?>"><br>
    Email: <input type="email" name="email" value="<?php echo $row['EMAIL']; ?>"><br>
    <input type="submit" value="Atualização">
</form>
