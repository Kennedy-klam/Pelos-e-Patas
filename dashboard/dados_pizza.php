<?php
include('../database/conexao.php');
header('Content-Type: application/json');

$sql = "
    SELECT especie.nome AS especie, COUNT(*) AS total
    FROM pet
    INNER JOIN especie ON especie.id_especie = pet.id_especie
    GROUP BY especie.nome
";

$result = $conn->query($sql);

$dados = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dados[] = $row; // cada $row tem 'especie' e 'total'
    }
}

echo json_encode($dados);
?>
