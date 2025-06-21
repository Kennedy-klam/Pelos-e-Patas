<?php
include('../database/conexao.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receber os dados do formulário
    $nome = trim($_POST['nome'] ?? '');
    $cpf = trim($_POST['cpf'] ?? '');
    $estado_civil = trim($_POST['estado_civil'] ?? '');
    $idade = intval($_POST['idade'] ?? 0);
    $sexoTexto = strtolower(trim($_POST['sexo'] ?? ''));
    $cep = $_POST['cep'] ?? '';
    $num_endereco = intval($_POST['num_endereco'] ?? 0);
    $complemento = trim($_POST['complemento'] ?? '');

    $telefone = trim($_POST['telefone'] ?? '');
    $telefone_fixo = trim($_POST['telefone_fixo'] ?? '');
    $email = trim($_POST['email'] ?? '');

    // sexo para número
    switch ($sexoTexto) {
        case 'feminino':
            $sexo = 1;
            break;
        case 'masculino':
            $sexo = 2;
            break;
        case 'outros':
            $sexo = 3;
            break;
        default:
            echo "<script>alert('Erro: Sexo inválido.'); window.history.back();</script>";
            exit();
    }

    // Validar dados mínimos (exemplo simples)
    if (empty($nome) || empty($cpf) || $sexo === 0) {
        echo "<script>alert('Por favor, preencha os campos obrigatórios.'); window.history.back();</script>";
        exit();
    }

    // Inserir na tabela cliente
    $stmtCliente = $conn->prepare("INSERT INTO cliente (nome, cpf, estado_civil, idade, sexo, cep, num_endereco, complemento) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmtCliente) {
        echo "<script>alert('Erro no banco: ".$conn->error."'); window.history.back();</script>";
        exit();
    }
    $stmtCliente->bind_param("sssiisss", $nome, $cpf, $estado_civil, $idade, $sexo, $cep, $num_endereco, $complemento);
    $executouCliente = $stmtCliente->execute();

    if (!$executouCliente) {
        echo "<script>alert('Erro ao inserir cliente: ".$stmtCliente->error."'); window.history.back();</script>";
        exit();
    }

    $idCliente = $stmtCliente->insert_id;

    // Inserir na tabela contato_cliente (email, telefone, telefone_fixo)
    $stmtContato = $conn->prepare("INSERT INTO contato_cliente (id_cliente, email, telefone, telefone_fixo) VALUES (?, ?, ?, ?)");
    if (!$stmtContato) {
        echo "<script>alert('Erro no banco: ".$conn->error."'); window.history.back();</script>";
        exit();
    }
    $stmtContato->bind_param("isss", $idCliente, $email, $telefone, $telefone_fixo);
    $executouContato = $stmtContato->execute();

    if (!$executouContato) {
        echo "<script>alert('Erro ao inserir contato: ".$stmtContato->error."'); window.history.back();</script>";
        exit();
    }

    // Sucesso
    echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='../dashboard/dash.php';</script>";
} else {
    echo "<script>alert('Método inválido.'); window.history.back();</script>";
}
?>