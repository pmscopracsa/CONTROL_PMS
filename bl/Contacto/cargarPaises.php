<?php
include_once '../ComboBoxSql.php';
include_once '../ComboBoxDireccion.php';

$selects = new ComboBoxDireccion();
$paises = $selects->cargarPais();

foreach ($paises as $key => $value) {
    echo "<option value=\"$key\">$value</option>";
}