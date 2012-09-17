<?php
include_once '../ComboBoxSql.php';
include_once '../ComboBoxDireccion.php';

$selects = new ComboBoxDireccion();
$paises = $selects->cargarPais();

foreach ($paises as $key => $value) {
    if($key == 177) {
        echo "<option value=\"$key\" selected='selected'>$value</option>";
        next($paises);
    }
    echo "<option value=\"$key\">$value</option>";
}