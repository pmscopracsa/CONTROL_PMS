<?php
include_once '../ComboBoxSql.php';
include_once '../ComboBoxTipos.php';

$selects = new ComboBoxTipos();
$tiposdireccion = $selects->cargarTipoDireccion();

foreach ($tiposdireccion as $key => $value) {
    echo "<option value=\"$key\">$value</option>";
}
?>
