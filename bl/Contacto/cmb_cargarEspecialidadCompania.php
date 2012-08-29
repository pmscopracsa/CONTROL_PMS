<?php
include_once '../ComboBoxSql.php';
include_once '../ComboBoxTipos.php';

$selects = new ComboBoxTipos();
$especialidades = $selects->cargarEspecialidades();

foreach ($especialidades as $key => $value) {
    echo '<option value="'.$key.'">'.$value.'</option>';
}