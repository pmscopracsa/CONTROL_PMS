<?php
include_once '../ComboBoxSql.php';
include_once '../ComboBoxDireccion.php';

$selects = new ComboBoxDireccion();
$selects->setCodigo_seleccion($_GET['code']);
$distritos = $selects->cargarDepartamento();

$id_departamento = $_REQUEST['id_departamento'];
foreach ($distritos as $key => $value) {
    if ($key == $id_departamento)
        echo "<option value=\"$key\" selected='selected'>$value</option>";
    echo "<option value=\"$key\">$value</option>";
}