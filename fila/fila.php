<?php 
include ('../database/conexao.php');
include ('../database/protect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id_castracao']);
    $acao = $_POST['acao'];

    if ($acao === 'confirmar') {
        $estado = 'confirmado';
    } elseif ($acao === 'cancelar') {
        $estado = 'cancelado';
    } else {
        $estado = null;
    }

    if ($estado) {
        $stmt = $conn->prepare("UPDATE castracao SET estado = ? WHERE id_castracao = ?");
        $stmt->bind_param('si', $estado, $id);
        $stmt->execute();
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Fila De Castração</title>
    <link rel="stylesheet" href="styles.css?v=123" />
</head>

<body>
    <header>
        <a href="../dashboard/dash.php" class="back-button" aria-label="Voltar">
            <img src="Imagens/back.svg" alt="Voltar" class="seta-svg" />
        </a>
        <img src="Imagens/Logo.png" alt="Logo Pelos&Patas" class="logo" />
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
            <th>DATA</th>
            <th>OPÇÕES</th>
        </tr>

        <?php
        $sql = "SELECT 
                    c.id_castracao, 
                    c.dia_castracao, 
                    c.observacao, 
                    p.sexo, 
                    cl.nome AS nome_cliente, 
                    e.nome AS nome_especie
                FROM castracao c
                INNER JOIN pet p ON c.id_pet = p.id_pet
                INNER JOIN cliente cl ON p.id_cliente = cl.id_cliente
                INNER JOIN especie e ON p.id_especie = e.id_especie
                WHERE c.estado IS NULL OR c.estado = ''
                ORDER BY c.dia_castracao ASC";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $genero = ($row['sexo'] == 2) ? 'Macho' : 'Fêmea';
                $dataFormatada = date("d/m/Y", strtotime($row['dia_castracao']));
                
                echo "<tr>
                        <td>{$row['id_castracao']}</td>
                        <td>{$row['nome_especie']}</td>
                        <td>{$genero}</td>
                        <td>{$row['observacao']}</td>
                        <td>{$row['nome_cliente']}</td>
                        <td>{$dataFormatada}</td>
                        <td>
                            <form method='POST' style='display:inline-block;'>
                                <input type='hidden' name='id_castracao' value='{$row['id_castracao']}'>
                                <button type='submit' name='acao' value='confirmar' class='padrao-button confirmar-button' onclick=\"return confirm('Deseja realmente confirmar esta castração?')\">Confirmar</button>
                            </form>
                            <form method='POST' style='display:inline-block; margin-left: 5px;'>
                                <input type='hidden' name='id_castracao' value='{$row['id_castracao']}'>
                                <button type='submit' name='acao' value='cancelar' class='padrao-button cancelar-button' onclick=\"return confirm('Deseja realmente cancelar esta castração?')\">Cancelar</button>
                            </form>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Nenhum registro encontrado.</td></tr>";
        }

        mysqli_close($conn);
        ?>
    </table>
</body>

</html>