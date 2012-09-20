<?php
require_once '../../../dl/contacto_bl/EspecialidadCompaniaDL.php';
$especialidad = new EspecialidadCompaniaDL();

if ($_REQUEST['parameter'] == 1) {

    $especialidades = $especialidad->mostrarEspecialidades();
    echo '<div>';
    echo '<div style:"float:left"><input type="text" id="txt_divEspecialidadBuscar"/><input type="button" value="Buscar" id="btnSearchEspecialidad" class="ui-button ui-widget ui-state-default ui-corner-all"></div>';
    foreach ($especialidades as $valor) {
        echo '<input id="especialidades_boxes" type="checkbox" name="especialidades[]" value="'.
                    $valor[0].
                    '"/>'.
                    $valor[1].
                    '<br/>';
    }
    echo '<div>';
} else {
    $especialidad->setDescripcion(@$_REQUEST['parameter']);
    $especialidades = $especialidad->mostrarEspecialidadesPorNombre();
    
    echo '<div>';
    echo '<div  style:"float:left"><input type="text" id="txt_divEspecialidadBuscar"/><input type="button" value="Buscar" id="btnSearchEspecialidad" class="ui-button ui-widget ui-state-default ui-corner-all"/></div>';
    foreach ($especialidades as &$valor) {
        echo '<input id="especialidades_boxes" type="checkbox" name="especialidades[]" value="'.
                $valor[0].
                '"/>'.
                $valor[1].
                '<br />';
    }
    echo '</div>';
}