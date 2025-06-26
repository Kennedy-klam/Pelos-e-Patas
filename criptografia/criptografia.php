<?php
$pdo = new PDO('mysql:host=localhost;dbname=pelosepatas_v3_1', 'root', '');

$stmt = $pdo->query("SELECT id_clinica, senhaclinica FROM clinica");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios as $usuario) {
    $id = $usuario['id_clinica'];
    $senha = $usuario['senhaclinica'];

    if (strpos($senha, '$2y$') !== 0) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        // Atualiza no banco
        $update = $pdo->prepare("UPDATE clinica SET senhaclinica = :senha WHERE id_clinica = :id");
        $update->execute(['senha' => $senhaHash, 'id' => $id]);

        echo "Senha da clínica $id atualizada com sucesso.<br>";
    } else {
        echo "Senha da clínica $id já está criptografada.<br>";
    }
}
?>
