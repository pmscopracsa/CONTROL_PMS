<?php
include_once '../ComboBoxSql.php';
include_once '../ComboBoxTipos.php';

$selects = new ComboBoxTipos();
$representantes = $selects->cargarRepresentantes();

foreach ($representantes as $key => $value) {
    echo '<option value="'.$key.'">'.$value.'</option>';
}