<?php
include_once '../ComboBoxSql.php';
include_once '../ComboBoxDireccion.php';

$selects = new ComboBoxDireccion();
$paises = $selects->cargarPais();

$id_pais = $_REQUEST['id_pais'];
foreach ($paises as $key => $value) {
    if ($key == $id_pais)
        echo "<option value=\"$key\" selected='selected'>$value</option>";
    echo "<option value=\"$key\">$value</option>";
}