<?php

$conn = new mysqli("localhost", "root", "SenaiSp", "ReservaEquipamentos");

$result = $conn->query("SELECT * FROM cliente_novo");

echo "<h2>Usuários</h2>";

echo"<h2>Lista de Equipamentos</h2>";
echo"<table border='1'>";
echo"<tr><th>CPF</th>
<th>NOME</th>
<th>EMAIL</th></tr>";

while ($row = $result->fetch_assoc()) {
echo"<tr>
     <td>{$row['CPF']}</td>
        <td>{$row['NOME']}</td>
        <td>{$row['EMAIL']}</td>
        <td><a href='editar.php?CPF={$row['CPF']}'>Editar</a></td>
    </tr>";
}
echo"</table>";
$conn->close();
?>

<a href="index.html"><button type="button">Página Inicial</button></a>


