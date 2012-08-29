<?php
include_once '../ComboBoxSql.php';
include_once '../ComboBoxTipos.php';

$selects = new ComboBoxTipos();
$viasenvio = $selects->cargarTipoEnvio();

foreach ($viasenvio as $key => $value) {
    echo "<option value=\"$key\">$value</option>";
}