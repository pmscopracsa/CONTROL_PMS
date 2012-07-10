<?php
require_once '../../../dl/contacto_bl/RepresentanteCompaniaDL.php';
$representanteCompania = new RepresentanteCompaniaDL();

$q = $_REQUEST['filtro'];

if ($q == "1" ) {
    $representantes = $representanteCompania->mostrarRepresentantes();
    
    foreach ($representantes as &$valor) {
        echo '<input id="representantes_boxes" type="checkbox" name="representantes[]" value="'.
                $valor[0].
                '"/>'.
                $valor[3].
                '<br />';
    }
} else {
    $representanteCompania->set_descripcionpersona($q);
    $representantes = $representanteCompania->mostrarRepresentatesPorNombre();
    
    foreach ($representantes as &$valor) {
        echo '<input id="representantes_boxes" type="checkbox" name="representantes[]" value="'.
                $valor[0].
                '"/>'.
                $valor[3].
                '<br />';
    }
}