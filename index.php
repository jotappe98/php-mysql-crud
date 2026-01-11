<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Header
include_once("templates/header.php");

// Busca dados necessários para montar o formulário
include_once("process/pizza.php");
?>

<div id="main-banner"></div>

<div id="main-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Monte sua pizza:</h2>
                <?php if (isset($_SESSION["msg"])): ?>
                <div class="alert alert-<?= $_SESSION["status"] ?>">
                    <?= $_SESSION["msg"] ?>
                </div>
                <?php
                    unset($_SESSION["msg"]);
                    unset($_SESSION["status"]);
                ?>
            <?php endif; ?>

                <form action="process/pizza.php" method="post" id="pizza-form">

                    <!-- BORDA -->
                    <div class="form-group">
                        <label for="borda">Borda:</label>
                        <select name="borda" id="borda" class="form-control form-select" required>
                            <option value="">Selecione a borda</option>
                            <?php foreach ($bordas as $borda): ?>
                                <option value="<?= $borda["id"] ?>">
                                    <?= $borda["tipo"] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- MASSA -->
                    <div class="form-group">
                        <label for="massa">Massa:</label>
                        <select name="massa" id="massa" class="form-control form-select" required>
                            <option value="">Selecione a massa</option>
                            <?php foreach ($massas as $massa): ?>
                                <option value="<?= $massa["id"] ?>">
                                    <?= $massa["tipo"] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- SABORES -->
                    <div class="form-group">
                        <label for="sabores">Sabores (máx. 3):</label>
                        <select multiple name="sabores[]" id="sabores" class="form-control form-select" required>
                            <?php foreach ($sabores as $sabor): ?>
                                <option value="<?= $sabor["id"] ?>">
                                    <?= $sabor["nome"] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- SUBMIT -->
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Fazer Pedido">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?php
include_once("templates/footer.php");
?>