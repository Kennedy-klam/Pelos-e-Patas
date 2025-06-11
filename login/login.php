<?php
include '../database/conexao.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $senha = trim($_POST["senha"]);

    $stmt = $conn->prepare("SELECT * FROM clinica WHERE emailclinica = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($senha, $usuario['senhaclinica'])) {
            $_SESSION['id_clinica'] = $usuario['id_clinica'];
            $_SESSION['nomeclinica'] = $usuario['nomeclinica']; 
            header("Location: ../dashboard/dash.php");
            exit();
        } else {
            echo "<script>alert('Senha incorreta');</script>";
        }
    } else {
        echo "<script>alert('E-mail não encontrado');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container-fluid">
    <div class="_content">
        <!--Parte Esquerda da tela-->
        <div class="left-panel">
            <div style= "width: 0" >
                <a href="../index.html">
                    <img src="imagens/arrow-left.svg" alt="Voltar">
                </a>
            </div>
          <h2> O gerenciamento certo para abrir a <br> sua clínica, você só encontra <br> <b>aqui!</b> </h2>
          <div class="paw-prints">
            <img class="paw-print" src="imagens/paw-print.svg" alt="paw print">
          </div>
          <img class="pets-image "src="imagens/pelos e patas.png" alt="pets">
        </div>

        <!--Parte Direita da tela-->
        <div class="right-panel">
            <div class="right-panel-content">
                <h3>Faça login para continuar</h3> <!--login-->
                <form id="loginForm" method="POST" action="" style="width: 100%;">
                    <div class="mb-4">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="mb-4 password-container">
                        <input type="password" name="senha" class="form-control" id="passwordImput" placeholder="Senha" required>
                        <span class="toggle-password" onclick="togglePassword()"> 
                            <img src="imagens/eye.svg">
                        </span>
                    </div>
                    <button type="submit" class="btn login-btn">Login</button>
                </form>
                <div class="admin-link">Para logar como adiministrador, <a href="#"> clique aqui</a></div>
            </div>
        </div>
    </div>
</div>

<script src="./login.js">
</script>

</body>