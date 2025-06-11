<?php 
include ('../database/conexao.php');
include ('../database/protect.php');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fila De Castração</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <a href="../dashboard/dash.php" class="back-button" aria-label="Voltar">
            <img src="Imagens/back.svg" alt="Voltar" class="seta-svg">
        </a>
        <img src="Imagens/Logo.png" alt="Logo Pelos&Patas" class="logo">
        <h1>Pelos&Patas</h1>
    </header>

    <span class="spacer"></span>

    <table>
        <tr>
            <th>ID</th>
            <th>ESPÉCIE</th>
            <th>GÊNERO</th>
            <th>OBSERVAÇÕES</th>
            <th>DONO</th>
            <th>OPÇÕES</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Cachorro</td>
            <td>Macho</td>
            <td>Teste</td>
            <td>João Silva</td>
            <td>
                <button class="padrao-button confirmar-button">Confirmar</button>
                <button class="padrao-button cancelar-button">Cancelar</button>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Gato</td>
            <td>Fêmea</td>
            <td>Teste</td>
            <td>João Silva</td>
            <td>
                <button class="padrao-button confirmar-button">Confirmar</button>
                <button class="padrao-button cancelar-button">Cancelar</button>
            </td>
        </tr>

    </table>

</body>

</html>