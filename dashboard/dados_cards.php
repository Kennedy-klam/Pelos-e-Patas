<?php
include('../database/conexao.php');

// Data atual no formato 'YYYY-MM-DD'
$hoje = date('Y-m-d');

// Total de castrações confirmadas hoje
$sql_confirmadas = "
    SELECT COUNT(*) as total
    FROM castracao
    WHERE estado = 'confirmado'
      AND dia_castracao = '$hoje'
";
$confirmadas_hoje = $conn->query($sql_confirmadas)->fetch_assoc()['total'];

// Total de castrações canceladas hoje
$sql_canceladas = "
    SELECT COUNT(*) as total
    FROM castracao
    WHERE estado = 'cancelado'
      AND dia_castracao = '$hoje'
";
$canceladas_hoje = $conn->query($sql_canceladas)->fetch_assoc()['total'];

// Total de castrações pendentes hoje (sem estado definido)
$sql_pendentes = "
    SELECT COUNT(*) as total
    FROM castracao
    WHERE (estado IS NULL OR estado = '')
      AND dia_castracao = '$hoje'
";
$pendentes_hoje = $conn->query($sql_pendentes)->fetch_assoc()['total'];

$conn->close();
?>
