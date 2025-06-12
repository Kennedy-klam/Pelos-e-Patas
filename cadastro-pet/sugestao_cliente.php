<?php
include('../database/conexao.php');

$termo = $_GET['termo'] ?? '';

$sugestoes = [];

if (!empty($termo)) {
    $termoLike = '%' . $termo . '%';
    $stmt = $conn->prepare("SELECT nome FROM cliente WHERE nome LIKE ? ORDER BY nome LIMIT 10");
    $stmt->bind_param("s", $termoLike);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $sugestoes[] = $row['nome'];
    }
}

header('Content-Type: application/json');
echo json_encode($sugestoes);
?>
