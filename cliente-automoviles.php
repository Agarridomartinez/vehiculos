<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title>Ejemplo de uso de servicio web</title>
</head>
<body>
<?php
require_once 'client/cliente.php';

try {
    $marcas = $client->ObtenerMarcas();
} catch (Exception $e) {
    echo($client->instance->__getLastResponse());
    echo PHP_EOL;
    echo($client->instance->__getLastRequest());
}

?>
<h1>Listado de marcas y modelos disponibles</h1>
<ul>
    <?php
    foreach ($marcas as $key => $value) {
        ?>
        <li><?= $value . "\n" ?>
            <ul>
                <?php
                $modelos = $client->ObtenerModelos($key);
                foreach ($modelos as $m) {
                    ?>
                    <li><?= $m ?></li>
                    <?php
                }
                ?>
            </ul>
        </li>
        <?php
    }
    ?>
</ul>
</body>
</html>