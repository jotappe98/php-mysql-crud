<?php

// Conexão com banco
include_once("conn.php");

/*
|--------------------------------------------------------------------------
| BUSCA DE PEDIDOS (GET)
| Arquivo exclusivo para montar a dashboard
|--------------------------------------------------------------------------
*/

// Busca pedidos
$pedidosQuery = $conn->query("SELECT * FROM pedidos;");
$pedidos = $pedidosQuery->fetchAll(PDO::FETCH_ASSOC);

$pizzas = [];

foreach ($pedidos as $pedido) {

    $pizza = [];
    $pizza["id"] = $pedido["pizza_id"];

    /*
    |--------------------------------------------------------------------------
    | DADOS DA PIZZA
    |--------------------------------------------------------------------------
    */
    $pizzaQuery = $conn->prepare(
        "SELECT * FROM pizzas WHERE id = :pizza_id"
    );
    $pizzaQuery->execute([
        ":pizza_id" => $pizza["id"]
    ]);

    $pizzaData = $pizzaQuery->fetch(PDO::FETCH_ASSOC);

    if (!$pizzaData) {
        continue;
    }

    /*
    |--------------------------------------------------------------------------
    | BORDA
    |--------------------------------------------------------------------------
    */
    $bordaQuery = $conn->prepare(
        "SELECT * FROM bordas WHERE id = :borda_id"
    );
    $bordaQuery->execute([
        ":borda_id" => $pizzaData["borda_id"]
    ]);
    $borda = $bordaQuery->fetch(PDO::FETCH_ASSOC);
    $pizza["borda"] = $borda["tipo"] ?? null;

    /*
    |--------------------------------------------------------------------------
    | MASSA
    |--------------------------------------------------------------------------
    */
    $massaQuery = $conn->prepare(
        "SELECT * FROM massas WHERE id = :massa_id"
    );
    $massaQuery->execute([
        ":massa_id" => $pizzaData["massa_id"]
    ]);
    $massa = $massaQuery->fetch(PDO::FETCH_ASSOC);
    $pizza["massa"] = $massa["tipo"] ?? null;

    /*
    |--------------------------------------------------------------------------
    | SABORES
    |--------------------------------------------------------------------------
    */
    $saboresQuery = $conn->prepare(
        "SELECT * FROM pizza_sabor WHERE pizza_id = :pizza_id"
    );
    $saboresQuery->execute([
        ":pizza_id" => $pizza["id"]
    ]);
    $sabores = $saboresQuery->fetchAll(PDO::FETCH_ASSOC);

    $saboresDaPizza = [];

    $saborQuery = $conn->prepare(
        "SELECT * FROM sabores WHERE id = :sabor_id"
    );

    foreach ($sabores as $sabor) {
        $saborQuery->execute([
            ":sabor_id" => $sabor["sabor_id"]
        ]);

        $saborPizza = $saborQuery->fetch(PDO::FETCH_ASSOC);

        if ($saborPizza) {
            $saboresDaPizza[] = $saborPizza["nome"];
        }
    }

    $pizza["sabores"] = $saboresDaPizza;

    /*
    |--------------------------------------------------------------------------
    | STATUS DO PEDIDO
    |--------------------------------------------------------------------------
    */
    $pizza["status"] = $pedido["status_id"];

    $pizzas[] = $pizza;
}

/*
|--------------------------------------------------------------------------
| STATUS DISPONÍVEIS
|--------------------------------------------------------------------------
*/
$statusQuery = $conn->query("SELECT * FROM status;");
$status = $statusQuery->fetchAll(PDO::FETCH_ASSOC);