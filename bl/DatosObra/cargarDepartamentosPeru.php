<?php
include_once '../ComboBoxSql.php';
include_once '../ComboBoxDireccion.php';

$selects = new ComboBoxDireccion();
$departamentos = $selects->cargarDepartamentosPeru();

foreach ($departamentos as $key => $value) {
    echo "<option value=\"$key\">$value</option>";
}
?>
