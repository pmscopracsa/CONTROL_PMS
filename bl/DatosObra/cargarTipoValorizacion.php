<?php
include_once '../ComboBoxSql.php';
include_once '../ComboBoxTipos.php';

$selects = new ComboBoxTipos();
$tipovalorizaciones = $selects->cargarTipoValorizacion();

foreach ($tipovalorizaciones as $key => $value) {
    echo "<option value=\"$key\">$value</option>";
}
?>