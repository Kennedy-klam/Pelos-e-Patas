<?php
include('../database/conexao.php');
include('../database/protect.php');

// Ativa erro detalhado do MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomePet = trim($_POST['NomePet'] ?? '');
    $nomeDono = trim($_POST['nomeDono'] ?? '');
    $porte = trim($_POST['portePet'] ?? '');
    $racaNome = trim($_POST['racaPet'] ?? '');
    $idade = isset($_POST['idadePet']) ? (int) $_POST['idadePet'] : null;
    $sexo = $_POST['sexo'] ?? '';
    $sexo = strtolower($sexo); // Garantir lowercase

    if ($sexo === 'femea') {
        $sexo = 1;
    } elseif ($sexo === 'macho') {
        $sexo = 2;
    } else {
        $sexo = null;
    }

    $especieNome = $_POST['especie'] ?? '';
    $obs = trim($_POST['observacaoCastracaoPet'] ?? '');

    $dia = str_pad($_POST['diaCadastro'] ?? '', 2, "0", STR_PAD_LEFT);
    $mes = str_pad($_POST['mesCadastro'] ?? '', 2, "0", STR_PAD_LEFT);
    $ano = $_POST['anoCadastro'] ?? '';
    $dataCadastro = "$ano-$mes-$dia";

    if (empty($nomePet) || empty($nomeDono) || empty($porte) || empty($racaNome) || empty($sexo) || empty($especieNome) || empty($dia) || empty($mes) || empty($ano)) {
        echo "<script>alert('Por favor, preencha todos os campos obrigatórios.'); window.history.back();</script>";
        exit();
    }

    // Buscar cliente
    $queryCliente = $conn->prepare("SELECT id_cliente FROM cliente WHERE nome = ?");
    $queryCliente->bind_param("s", $nomeDono);
    $queryCliente->execute();
    $resultCliente = $queryCliente->get_result();

    if ($resultCliente->num_rows === 0) {
        echo "<script>alert('Cliente não encontrado. Cadastre o cliente primeiro.'); window.location.href='../cadastro-pessoa/cadastro-pessoa.php';</script>";
        exit();
    }

    $idCliente = $resultCliente->fetch_assoc()['id_cliente'];

    // Inserir ou verificar espécie
    $queryEspecie = $conn->prepare("SELECT id_especie FROM especie WHERE nome = ?");
    $queryEspecie->bind_param("s", $especieNome);
    $queryEspecie->execute();
    $resultEspecie = $queryEspecie->get_result();

    if ($resultEspecie->num_rows > 0) {
        $idEspecie = $resultEspecie->fetch_assoc()['id_especie'];
    } else {
        $insertEspecie = $conn->prepare("INSERT INTO especie (nome) VALUES (?)");
        $insertEspecie->bind_param("s", $especieNome);
        $insertEspecie->execute();
        $idEspecie = $insertEspecie->insert_id;
    }

    if (!isset($idEspecie)) {
        echo "<script>alert('Erro ao definir a espécie.'); window.history.back();</script>";
        exit();
    }

    // Inserir raça se não existir
    $queryRaca = $conn->prepare("SELECT id_raca FROM raca WHERE nome = ?");
    $queryRaca->bind_param("s", $racaNome);
    $queryRaca->execute();
    $resultRaca = $queryRaca->get_result();

    if ($resultRaca->num_rows === 0) {
        $insertRaca = $conn->prepare("INSERT INTO raca (nome, id_especie) VALUES (?, ?)");
        $insertRaca->bind_param("si", $racaNome, $idEspecie);
        $insertRaca->execute();
    }

    // Inserir PET
    $insertPet = $conn->prepare("INSERT INTO pet (nome, porte, idade, sexo, id_cliente, id_especie) VALUES (?, ?, ?, ?, ?, ?)");
    $insertPet->bind_param("ssiiii", $nomePet, $porte, $idade, $sexo, $idCliente, $idEspecie);
    $insertPet->execute();
    $idPet = $insertPet->insert_id;

    // Inserir castração
    $idClinica = $_SESSION['id_clinica'] ?? null;

    if (!$idClinica) {
        echo "<script>alert('Erro: Clínica não identificada.'); window.history.back();</script>";
        exit();
    }

    $insertCastracao = $conn->prepare("INSERT INTO castracao (dia_castracao, observacao, id_clinica, id_pet) VALUES (?, ?, ?, ?)");
    $insertCastracao->bind_param("ssii", $dataCadastro, $obs, $idClinica, $idPet);
    $insertCastracao->execute();

    echo "<script>alert('Cadastro do pet realizado com sucesso!'); window.location.href='../dashboard/dash.php';</script>";
} else {
    echo "Método inválido.";
}
?>