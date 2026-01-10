<?php
    include_once("templates/header.php");
    include_once("process/pizza.php");
?>
    <div id="main-banner">

    </div>
    <div id="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Monte sua pizza:</h2>
                    <form action="process/pizza.php" method="post" id="pizza-form">
                        <div class="form-group">
                            <label for="borda">Borda:</label>
                            <select name="borda" id="borda" class="form-control form-select">
                                <option class="opt" value="">Selecione a borda</option>
                                <?php foreach($bordas as $borda): ?>
                                <option class="opt" value="<?= $borda["id"] ?>"><?= $borda["tipo"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                         <div class="form-group">
                            <label for="massa">Massa:</label>
                            <select name="massa" id="massa" class="form-control form-select">
                                <option value="">Selecione a massa</option>
                                 <?php foreach($massas as $massa): ?>
                                <option value="<?= $massa["id"] ?>"><?= $massa["tipo"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                         <div class="form-group">
                            <label for="sabores">Sabores:(Máximo 3)</label>
                            <select multiple name="sabores[]" id="sabores" class="form-control form-select">
                               <?php foreach($sabores as $sabor): ?>
                                <option class="opt" value="<?= $sabor["id"] ?>"><?= $sabor["nome"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
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

