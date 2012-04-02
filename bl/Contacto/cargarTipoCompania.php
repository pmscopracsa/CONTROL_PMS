<?php
include_once '../ComboBoxSql.php';
include_once '../ComboBoxTipos.php';

$selects = new ComboBoxTipos();
$tipocompanias = $selects->cargaTipoCompania();

foreach ($tipocompanias as $key => $value) {
    echo "<option value=\"$key\">$value</option>";
}
?>
