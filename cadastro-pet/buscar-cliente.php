<?php
include('../database/conexao.php');

$nome = $_GET['nome'] ?? '';
$response = ['found' => false];

if (!empty($nome)) {
    // Primeiro, tenta buscar por nome exato
    $queryCliente = "SELECT id_cliente FROM cliente WHERE nome = ?";
    $stmtCliente = $conn->prepare($queryCliente);
    $stmtCliente->bind_param("s", $nome);
    $stmtCliente->execute();
    $resultCliente = $stmtCliente->get_result();

    // Se não encontrou nome exato, tenta por LIKE (semelhante)
    if ($resultCliente->num_rows === 0) {
        $nomeLike = "%$nome%";
        $stmtCliente = $conn->prepare("SELECT id_cliente, nome FROM cliente WHERE nome LIKE ? LIMIT 1");
        $stmtCliente->bind_param("s", $nomeLike);
        $stmtCliente->execute();
        $resultCliente = $stmtCliente->get_result();
    }

    if ($cliente = $resultCliente->fetch_assoc()) {
        $idCliente = $cliente['id_cliente'];

        // Buscar email e telefone do cliente
        $stmtContato = $conn->prepare("SELECT email, telefone FROM contato_cliente WHERE id_cliente = ?");
        $stmtContato->bind_param("i", $idCliente);
        $stmtContato->execute();
        $resultContato = $stmtContato->get_result();

        if ($contato = $resultContato->fetch_assoc()) {
            $response['found'] = true;
            $response['email'] = $contato['email'] ?? '';
            $response['telefone'] = $contato['telefone'] ?? '';
        }
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>