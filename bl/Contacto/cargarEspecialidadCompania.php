<?php
include_once '../CheckBoxSql.php';
include_once '../CheckBoxEspecialidadCompania.php';

$checks = new CheckBoxEspecialidad();
$especialidades = $checks->cargarEspecialidad();

foreach ($especialidades as $key => $value) {
    echo '<input type="checkbox" name="especialidadcompania[]" value="'.$value.'"/>"'.$value;
}
?>
