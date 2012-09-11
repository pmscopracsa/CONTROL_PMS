<?php
include_once '../ComboBoxSql.php';
include_once '../ComboBoxTipos.php';

$selects = new ComboBoxTipos();
$formatospresupuesto = $selects->cargarFormatoPresupuesto();
$idformato = $_REQUEST['id_formato'];
foreach ($formatospresupuesto as $key => $value) {
    if ($key == $idformato)
        echo "<option value=\"$key\" selected='selected'>$value</option>";
    echo "<option value=\"$key\">$value</option>";
}