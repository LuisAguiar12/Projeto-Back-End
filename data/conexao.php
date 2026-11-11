<?php 

$conn = new mysqli("localhost", "root", "", "lewis");

if ($conn->connect_error) {
    die("Erro na conexao:" . $conn->connect_error)
}

$conn->set_charset("utf8mb4");
?>