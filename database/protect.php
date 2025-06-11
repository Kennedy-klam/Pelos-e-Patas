<?php 
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id_clinica'])) {
    echo "
    <script>
        if (confirm('Você não está logado. Deseja ir para a tela de login?')) {
            window.location.href = '../login/login.php';
        } else {
            alert('Você precisa estar logado para acessar esta página.');
        }
    </script>
    ";
    exit();
}
?>
