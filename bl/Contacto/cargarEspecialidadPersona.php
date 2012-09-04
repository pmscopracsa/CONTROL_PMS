<?php
include_once '../CheckBoxSql.php';
include_once '../CheckBoxEspecialidadPersona.php';

$checks = new CheckBoxEspecialidadPersona();
$especialidades = $checks->cargarEspecialidadPersona();

foreach ($especialidades as $key => $value) {
    echo '<input type="checkbox" name="especialidadpersona[]" value="'.$key.'"/>"'.$value.'<br />';
}