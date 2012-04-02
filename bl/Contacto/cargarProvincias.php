<?php
include_once '../ComboBoxSql.php';
include_once '../ComboBoxDireccion.php';

$selects = new ComboBoxDireccion();
$selects->setCodigo_seleccion($_GET['code']);
$provincias = $selects->cargarProvincia();

foreach ($provincias as $key => $value) {
    echo "<option value=\"$key\">$value</option>";
}
?>
