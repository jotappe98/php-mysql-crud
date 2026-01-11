<?php

// Dados de conexão
$host = "localhost";
$db   = "pizzaria";
$user = "jotape";
$pass = "jotape";

try {

    $conn = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8",
        $user,
        $pass
    );

    // Mostra erros do banco como exceção
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Desativa emulação de prepared statements
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

} catch (PDOException $e) {
    echo "Erro na conexão com o banco: " . $e->getMessage();
    exit;
}