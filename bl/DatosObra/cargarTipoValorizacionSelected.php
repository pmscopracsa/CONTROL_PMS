<?php
include_once '../ComboBoxSql.php';
include_once '../ComboBoxTipos.php';

$selects = new ComboBoxTipos();
$tipovalorizaciones = $selects->cargarTipoValorizacion();
$idvalorizacion = $_REQUEST['id_valorizacion'];
foreach ($tipovalorizaciones as $key => $value) {
    if ($key == $idvalorizacion)
        echo "<option value=\"$key\" selected='selected'>$value</option>";
    echo "<option value=\"$key\">$value</option>";
}