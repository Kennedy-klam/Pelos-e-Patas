<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../database/conexao.php');

header('Content-Type: application/json');

// Query que seleciona sexo, especie, idade e total de pets castrados confirmados
$sql = "
    SELECT 
        p.sexo,
        e.nome AS especie,
        p.idade,
        COUNT(*) AS total
    FROM pet p
    INNER JOIN especie e ON p.id_especie = e.id_especie
    INNER JOIN castracao c ON p.id_pet = c.id_pet
    WHERE c.estado = 'confirmado'
    GROUP BY p.sexo, e.nome, p.idade
    ORDER BY e.nome, p.sexo, p.idade
";

$result = $conn->query($sql);

$dados = [];

while ($row = $result->fetch_assoc()) {
    // Converte sexo de 1/2 para texto
    $row['sexo'] = ($row['sexo'] == 1) ? 'femea' : 'macho';
    $dados[] = $row;
}

echo json_encode($dados);
$conn->close();
?>
