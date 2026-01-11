<?php

// Conexão com banco
include_once("conn.php");

// Sessão só se ainda não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$method = $_SERVER["REQUEST_METHOD"];

/*
|--------------------------------------------------------------------------
| GET → Buscar dados para montar o formulário
|--------------------------------------------------------------------------
*/
if ($method === "GET") {

    $bordasQuery = $conn->query("SELECT * FROM bordas;");
    $bordas = $bordasQuery->fetchAll(PDO::FETCH_ASSOC);

    $massasQuery = $conn->query("SELECT * FROM massas;");
    $massas = $massasQuery->fetchAll(PDO::FETCH_ASSOC);

    $saboresQuery = $conn->query("SELECT * FROM sabores;");
    $sabores = $saboresQuery->fetchAll(PDO::FETCH_ASSOC);

/*
|--------------------------------------------------------------------------
| POST → Criação do pedido
|--------------------------------------------------------------------------
*/
} else if ($method === "POST") {

    $borda   = $_POST["borda"]   ?? null;
    $massa   = $_POST["massa"]   ?? null;
    $sabores = $_POST["sabores"] ?? [];

    // Validação: campos obrigatórios
    if (!$borda || !$massa || empty($sabores)) {
        $_SESSION["msg"] = "Preencha todos os campos do pedido.";
        $_SESSION["status"] = "warning";
        header("Location: ../index.php");
        exit;
    }

    // Validação: máximo 3 sabores
    if (count($sabores) > 3) {
        $_SESSION["msg"] = "Selecione no máximo 3 sabores.";
        $_SESSION["status"] = "warning";
        header("Location: ../index.php");
        exit;
    }

    try {
        // Inicia transação
        $conn->beginTransaction();

        // Cria pizza
        $stmt = $conn->prepare(
            "INSERT INTO pizzas (borda_id, massa_id) VALUES (:borda, :massa)"
        );
        $stmt->bindParam(":borda", $borda, PDO::PARAM_INT);
        $stmt->bindParam(":massa", $massa, PDO::PARAM_INT);
        $stmt->execute();

        $pizzaId = $conn->lastInsertId();

        // Relaciona sabores
        $stmt = $conn->prepare(
            "INSERT INTO pizza_sabor (pizza_id, sabor_id) VALUES (:pizza, :sabor)"
        );

        foreach ($sabores as $sabor) {
            $stmt->bindParam(":pizza", $pizzaId, PDO::PARAM_INT);
            $stmt->bindParam(":sabor", $sabor, PDO::PARAM_INT);
            $stmt->execute();
        }

        // Cria pedido
        $statusId = 1; // Status inicial

        $stmt = $conn->prepare(
            "INSERT INTO pedidos (pizza_id, status_id) VALUES (:pizza, :status)"
        );
        $stmt->bindParam(":pizza", $pizzaId, PDO::PARAM_INT);
        $stmt->bindParam(":status", $statusId, PDO::PARAM_INT);
        $stmt->execute();

        // Confirma transação
        $conn->commit();

        $_SESSION["msg"] = "Pedido realizado com sucesso!";
        $_SESSION["status"] = "success";

    } catch (Exception $e) {

        // Cancela tudo se der erro
        $conn->rollBack();

        $_SESSION["msg"] = "Erro ao realizar o pedido.";
        $_SESSION["status"] = "danger";
    }

    // Volta para a home
    header("Location: /php-mysql-crud/index.php");
    exit;
}

