<?php
include_once '../ComboBoxSql.php';
include_once '../ComboBoxTipos.php';

$selects = new ComboBoxTipos();
$monedas = $selects->cargarMoneda();
$idmoneda = $_REQUEST['id_moneda'];
foreach ($monedas as $key => $value) {
    if ($key == $idmoneda)
        echo "<option value='$key' selected='selected'>$value</option>";
    echo "<option value='$key'>$value</option>";
}