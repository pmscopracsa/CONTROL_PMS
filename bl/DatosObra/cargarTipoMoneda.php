<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../ComboBoxSql.php';
include_once '../ComboBoxTipos.php';

$selects = new ComboBoxTipos();
$monedas = $selects->cargarMoneda();

foreach ($monedas as $key => $value) {
    echo "<option value\"$key\">$value</option>";
}
?>
