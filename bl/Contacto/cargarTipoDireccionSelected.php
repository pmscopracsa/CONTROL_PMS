<?php
include_once '../ComboBoxSql.php';
include_once '../ComboBoxTipos.php';

$selects = new ComboBoxTipos();
$tiposdireccion = $selects->cargarTipoDireccion();
$id_tipodomicilio = $_REQUEST['id_tipodomicilio'];
foreach ($tiposdireccion as $key => $value) {
    if ($key == $id_tipodomicilio)
        echo "<option value=\"$key\" selected='selected'>$value</option>";
    echo "<option value=\"$key\">$value</option>";
}