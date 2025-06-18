<?php
include('../database/conexao.php');

// Total de castrações confirmadas nos últimos 30 dias
$sql_total = "
    SELECT COUNT(*) as total
    FROM castracao
    WHERE estado = 'confirmado'
      AND dia_castracao >= CURDATE() - INTERVAL 30 DAY
";
$total = $conn->query($sql_total)->fetch_assoc()['total'];

// Total de machos castrados
$sql_machos = "
    SELECT COUNT(*) as total
    FROM castracao c
    JOIN pet p ON c.id_pet = p.id_pet
    WHERE c.estado = 'confirmado'
      AND p.sexo = 2
      AND c.dia_castracao >= CURDATE() - INTERVAL 30 DAY
";
$machos = $conn->query($sql_machos)->fetch_assoc()['total'];

// Total de fêmeas castradas
$sql_femeas = "
    SELECT COUNT(*) as total
    FROM castracao c
    JOIN pet p ON c.id_pet = p.id_pet
    WHERE c.estado = 'confirmado'
      AND p.sexo = 1
      AND c.dia_castracao >= CURDATE() - INTERVAL 30 DAY
";
$femeas = $conn->query($sql_femeas)->fetch_assoc()['total'];

// Total de castrações canceladas
$sql_canceladas = "
    SELECT COUNT(*) as total
    FROM castracao
    WHERE estado = 'cancelado'
      AND dia_castracao >= CURDATE() - INTERVAL 30 DAY
";
$canceladas = $conn->query($sql_canceladas)->fetch_assoc()['total'];
$conn->close();
?>
