<?php

    include_once("conn.php");


    $method = $_SERVER['REQUEST_METHOD'];
        //Pega os dados, montagem pedido
        if($method === "GET") {

            $bordasQuery = $conn->query ("SELECT * FROM bordas;");
            $bordas = $bordasQuery->fetchAll();

            $massasQuery = $conn->query ("SELECT * FROM massas;");
            $massas = $massasQuery->fetchAll();

            $saboresQuery = $conn->query ("SELECT * FROM sabores;");
            $sabores = $saboresQuery->fetchAll();


        //Criação do pedido
        } else if ($method === "POST") {

            $data = $_POST;

            $borda = $data['borda'];
            $massa = $data['massa'];
            $sabores = $data['sabores'];

            // Validação, máximo 3 sabores

           if (count($sabores) > 3) {
                // Retorna erro
                $_SESSION["msg"] = "Selecione no máximo 3 sabores";
                $_SESSION["status"] = "warning";
            } else {
                
                $stmt = $conn->prepare("INSERT INTO pizzas (borda_id, massa_id) VALUES (:borda, :massa)");

                $stmt->bindParam(":borda", $borda, PDO::PARAM_INT);
                $stmt->bindParam(":massa", $massa, PDO::PARAM_INT);

                $stmt->execute();

                $pizzaId = $conn->lastInsertId();


                $stmt = $conn->prepare("INSERT INTO pizza_sabor (pizza_id, sabor_id) VALUES (:pizza, :sabor)");

                foreach ($sabores as $sabor) {

                    $stmt->bindParam (":pizza", $pizzaId, PDO::PARAM_INT);
                    $stmt->bindParam (":sabor", $sabor, PDO::PARAM_INT);

                    $stmt->execute();

                }

            }

            //Volta pra home
            header("Location: ..");
            exit();
        }
?>


