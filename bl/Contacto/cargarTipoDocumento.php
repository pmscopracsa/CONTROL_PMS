<?php
include_once '../ComboBoxSql.php';
include_once '../ComboBoxTipos.php';

$selects = new ComboBoxTipos();
$tiposdocumento = $selects->cargarTipoDocumento();

foreach ($tiposdocumento as $key => $value) {
    echo "<option value=\"$key\">$value</option>";
}