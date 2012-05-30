<?php
include_once '../ComboBoxSql.php';
include_once '../ComboBoxTipos.php';

$selects = new ComboBoxTipos();
$formatospresupuesto = $selects->cargarFormatoPresupuesto();

foreach ($formatospresupuesto as $key => $value) {
    echo "<option value=\"$key\">$value</option>";
}
?>