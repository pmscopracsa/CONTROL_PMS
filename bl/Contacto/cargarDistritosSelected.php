<?php
include_once '../ComboBoxSql.php';
include_once '../ComboBoxDireccion.php';

$selects = new ComboBoxDireccion();
$selects->setCodigo_seleccion($_GET['code']);
$distritos = $selects->cargarDistrito();

$id_distrito = $_REQUEST['id_distrito'];
foreach ($distritos as $key => $value) {
    if ($key == $id_distrito)
        echo "<option value=\"$key\" selected='selected'>$value</option>";
    echo "<option value=\"$key\">$value</option>";
}