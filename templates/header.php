<?php
    include_once("process/conn.php");

    $msg = "";

    if (isset($_SESSION["msg"])) {

        $msg = $_SESSION["msg"];
        $status = $_SESSION["status"];

        $_SESSION["msg"] = "";
        $_SESSION["status"] = "";

    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/php-mysql-crud/CSS/styles.css">
    <title>Faça seu Pedido</title>
</head>
<body>
    <header>




    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
            <img src="/php-mysql-crud/assets/img/pizza.svg" alt="Elo's Pizza" id="brand-logo">
            <span class="brand-text text-white">
                Bem vindo(a)! Peça sua pizza.
            </span>
        </a>
    </nav>
</header>


<?php if($msg != ""): ?>

<div class="alert alert-<?= $status ?>">
    <p>
        <?=  $msg ?>
    </p>
</div>

<?php endif; ?>