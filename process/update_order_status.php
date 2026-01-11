<?php

require_once("../process/conn.php");

// Inicia sessão se ainda não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Valida se os dados vieram corretamente
if (!isset($_POST["id"], $_POST["status"])) {
    $_SESSION["msg"] = "Dados inválidos para atualização do pedido";
    $_SESSION["status"] = "error";
    header("Location: ../dashboard.php");
    exit;
}

$pizzaId  = (int) $_POST["id"];
$statusId = (int) $_POST["status"];

// Atualiza status do pedido
$updateQuery = $conn->prepare(
    "UPDATE pedidos 
     SET status_id = :status_id 
     WHERE pizza_id = :pizza_id"
);

$updateQuery->bindParam(":pizza_id", $pizzaId, PDO::PARAM_INT);
$updateQuery->bindParam(":status_id", $statusId, PDO::PARAM_INT);

if ($updateQuery->execute()) {
    $_SESSION["msg"] = "Pedido atualizado com sucesso";
    $_SESSION["status"] = "success";
} else {
    $_SESSION["msg"] = "Erro ao atualizar o pedido";
    $_SESSION["status"] = "error";
}

// Redireciona de volta para dashboard
header("Location: ../dashboard.php");
exit;