<?php
require_once('../../../dl/contacto_bl/EspecialidadCompaniaDL.php');
$especialidadcompania = new EspecialidadCompaniaDL();


$q = $_REQUEST['filtro'];

if ($q == "1") {
    $especialidades = $especialidadcompania->mostrarEspecialidades();

    foreach ($especialidades as &$valor) {
        echo '<input id="especialidades_boxes" type="checkbox" name="especialidades[]" value="'.
                $valor[0].
                '"/>'.
                $valor[1].
                '<br />';
    }
} else {
    $especialidadcompania->setDescripcion($q);
    $especialidades = $especialidadcompania->mostrarEspecialidadesPorNombre();
    

    foreach ($especialidades as &$valor) {
        echo '<input id="especialidades_boxes" type="checkbox" name="especialidades[]" value="'.
                $valor[0].
                '"/>'.
                $valor[1].
                '<br />';
    }
}