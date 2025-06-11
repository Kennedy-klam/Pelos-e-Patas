<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include('../database/conexao.php');

header('Content-Type: application/json');

$sql = "SELECT sexo, especie, COUNT(*) AS total FROM teste GROUP BY sexo, especie";
$result = $conn->query($sql);

$dados = [];

while ($row = $result->fetch_assoc()) {
    $dados[] = $row;
}

echo json_encode($dados);
$conn->close();
?>