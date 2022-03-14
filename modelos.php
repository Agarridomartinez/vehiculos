<div class="marca-wrapper">
<?php
$marca = $_GET['marca'];
require_once "client/cliente.php";


$modelos = $client->instance->ObtenerModelosPorMarca($marca);

foreach ($modelos as $key => $value){
    ?>
    <div class="figure">
        <span><?= $value ?></span>
    </div>
    <?php
    }
?>
</div>

