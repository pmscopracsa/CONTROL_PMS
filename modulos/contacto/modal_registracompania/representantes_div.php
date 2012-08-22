<?php
require_once '../../../dl/contacto_bl/RepresentanteCompaniaDL.php';
$representanteCompania = new RepresentanteCompaniaDL();

$q = $_REQUEST['filtro'];

if ($q == "1" ) {
    $representantes = $representanteCompania->mostrarRepresentantes();
    echo '<div>';
    echo '<div  style:"float:left"><input type="text" id="txt_divRepresentanteBuscar"/><input type="button" value="Buscar" id="btnSearchRepresentante" class="ui-button ui-widget ui-state-default ui-corner-all"/></div>';
    foreach ($representantes as &$valor) {
        echo '<input id="representantes_boxes" type="checkbox" name="representantes[]" value="'.
                $valor[0].
                '"/>'.
                $valor[3].
                '<br />';
    }
    echo '</div>';
} else {
    $representanteCompania->set_descripcionpersona($q);
    $representantes = $representanteCompania->mostrarRepresentatesPorNombre();
    echo '<div>';
    echo '<div  style:"float:left"><input type="text" id="txt_divRepresentanteBuscar"/><input type="button" value="Buscar" id="btnSearchRepresentante" class="ui-button ui-widget ui-state-default ui-corner-all"/></div>';
    foreach ($representantes as &$valor) {
        echo '<input id="representantes_boxes" type="checkbox" name="representantes[]" value="'.
                $valor[0].
                '"/>'.
                $valor[3].
                '<br />';
    }
    echo '</div>';
}