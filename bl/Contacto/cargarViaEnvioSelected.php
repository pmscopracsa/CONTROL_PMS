<?php
include_once '../ComboBoxSql.php';
include_once '../ComboBoxTipos.php';

$selects = new ComboBoxTipos();
$viasenvio = $selects->cargarTipoEnvio();

$id_viaenvio = $_REQUEST['id_viaenvio'];
foreach ($viasenvio as $key => $value) {
    if($key == $id_viaenvio)
        echo "<option value=\"$key\" selected>$value</option>";
    echo "<option value=\"$key\">$value</option>";
}