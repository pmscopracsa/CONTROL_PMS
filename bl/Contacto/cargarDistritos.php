<?php
include_once '../ComboBoxSql.php';
include_once '../ComboBoxDireccion.php';

$selects = new ComboBoxDireccion();
$selects->setCodigo_seleccion($_GET['code']);
$distritos = $selects->cargarDistrito();

foreach ($distritos as $key => $value) {
    echo "<option value=\"$key\">$value</option>";
}
?>
