<?php
// Inicia a sessão
session_start();

// Header
include_once("templates/header.php");

// Busca pedidos (GET)
include_once("process/orders_fetch.php");
?>

<div class="main-cont">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h2>Gerenciar pedidos</h2>

                <?php if (isset($_SESSION["msg"])): ?>
                    <div class="alert alert-<?= $_SESSION["status"] ?>">
                        <?= $_SESSION["msg"] ?>
                    </div>
                    <?php
                        unset($_SESSION["msg"]);
                        unset($_SESSION["status"]);
                    ?>
                <?php endif; ?>
            </div>

            <div class="col-md-12 table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th># Pedido</th>
                            <th>Borda</th>
                            <th>Massa</th>
                            <th>Sabores</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($pizzas as $pizza): ?>
                            <tr>
                                <td><?= $pizza["id"] ?></td>
                                <td><?= $pizza["borda"] ?></td>
                                <td><?= $pizza["massa"] ?></td>

                                <td>
                                    <ul>
                                        <?php foreach ($pizza["sabores"] as $sabor): ?>
                                            <li><?= $sabor ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </td>

                                <!-- STATUS -->
                                <td>
                                    <form action="process/update_order_status.php" method="post" class="form-group update-form">
                                        <input type="hidden" name="type" value="update">
                                        <input type="hidden" name="id" value="<?= $pizza["id"] ?>">

                                        <select name="status" class="form-control status-input">
                                            <?php foreach ($status as $s): ?>
                                                <option 
                                                    value="<?= $s["id"] ?>"
                                                    <?= ($s["id"] == $pizza["status"]) ? "selected" : "" ?>
                                                >
                                                    <?= $s["tipo"] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>

                                        <button type="submit" class="update-btn">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    </form>
                                </td>

                                <!-- DELETE -->
                                <td>
                                    <form action="process/orders.php" method="post">
                                        <input type="hidden" name="type" value="delete">
                                        <input type="hidden" name="id" value="<?= $pizza["id"] ?>">

                                        <button type="submit" class="delete-btn">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>

<?php
include_once("templates/footer.php");
?>