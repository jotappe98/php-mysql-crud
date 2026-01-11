<?php

// Sessão apenas se ainda não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once("conn.php");

$method = $_SERVER["REQUEST_METHOD"];

if ($method === "POST") {

    $type = $_POST["type"] ?? null;

    // Remove pedido
    if ($type === "delete") {

        $pizzaId = $_POST["id"] ?? null;

        if ($pizzaId) {

            $deleteQuery = $conn->prepare(
                "DELETE FROM pedidos WHERE pizza_id = :pizza_id"
            );

            $deleteQuery->bindParam(
                ":pizza_id",
                $pizzaId,
                PDO::PARAM_INT
            );

            $deleteQuery->execute();

            $_SESSION["msg"] = "Pedido removido com sucesso!";
            $_SESSION["status"] = "success";
        }
    }

    // Redireciona pra dashboard
    header("Location: /php-mysql-crud/dashboard.php");
    exit;
}