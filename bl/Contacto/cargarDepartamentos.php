<?php
include_once '../ComboBoxSql.php';
include_once '../ComboBoxDireccion.php';

$selects = new ComboBoxDireccion();
$selects->setCodigo_seleccion($_GET['code']);
$departamentos = $selects->cargarDepartamento();

foreach ($departamentos as $key => $value) {
//    if($key == 2911){
//        echo "<option value=\"$key\" selected='selected'>$value</option>";
//        continue;
//    }
    echo "<option value=\"$key\">$value</option>";
}