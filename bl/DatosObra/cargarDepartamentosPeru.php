<?php
include_once '../ComboBoxSql.php';
include_once '../ComboBoxDireccion.php';

$selects = new ComboBoxDireccion();
$departamentos = $selects->cargarDepartamentosPeru();

foreach ($departamentos as $key => $value) {
    if($value == 'Lima'){
        echo "<option value=\"$key\" selected='selected'>$value</option>";
        continue;
    }
    echo "<option value=\"$key\">$value</option>";
}