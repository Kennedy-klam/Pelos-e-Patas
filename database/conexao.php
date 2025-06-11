<?php
$servername = "localhost";
$database = "pelosepatas_v3_1";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

?>
