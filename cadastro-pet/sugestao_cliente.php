<?php
include('../database/conexao.php');

$nome = $_GET['nome'] ?? '';
$nome = '%' . $nome . '%';

$sql = "
  SELECT c.id_cliente, c.nome, c.cpf, cc.email, cc.telefone
  FROM cliente c
  LEFT JOIN contato_cliente cc ON c.id_cliente = cc.id_cliente
  WHERE c.nome LIKE ?
  LIMIT 10
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nome);
$stmt->execute();
$result = $stmt->get_result();

$clientes = [];
while ($row = $result->fetch_assoc()) {
    $clientes[] = $row;
}

header('Content-Type: application/json');
echo json_encode($clientes);
?>
