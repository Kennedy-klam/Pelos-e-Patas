<?php
include('../database/conexao.php');

$nome = $_GET['nome'] ?? '';

$response = ['found' => false];

if (!empty($nome)) {
    // Buscar o cliente pelo nome
    $queryCliente = "SELECT id_cliente FROM cliente WHERE nome = ?";
    $stmtCliente = $conn->prepare($queryCliente);
    $stmtCliente->bind_param("s", $nome);
    $stmtCliente->execute();
    $resultCliente = $stmtCliente->get_result();

    if ($cliente = $resultCliente->fetch_assoc()) {
        $idCliente = $cliente['id_cliente'];

        // Buscar email e telefone na tabela contato_cliente pelo id_cliente
        $queryContato = "SELECT email, telefone FROM contato_cliente WHERE id_cliente = ?";
        $stmtContato = $conn->prepare($queryContato);
        $stmtContato->bind_param("i", $idCliente);
        $stmtContato->execute();
        $resultContato = $stmtContato->get_result();

        if ($contato = $resultContato->fetch_assoc()) {
            $response['found'] = true;
            $response['email'] = $contato['email'];
            $response['telefone'] = $contato['telefone'];
        }
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>