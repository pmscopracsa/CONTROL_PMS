<?php
require_once('../../../dl/contacto_bl/EspecialidadCompaniaDL.php');
$especialidadcompania = new EspecialidadCompaniaDL();
$especialidades = $especialidadcompania->mostrarEspecialidades();

foreach ($especialidades as &$valor) {
    echo '<input id="especialidades_boxes" type="checkbox" name="especialidades[]" value="'.
            $valor[0].
            '"/>'.
            $valor[1].
            '<br />';
}
?>