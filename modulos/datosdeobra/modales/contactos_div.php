<?php
require_once '../../../dl/contacto_bl/ContactoPersona.php';
$representanteCompania = new ContactoPersona();

$q = $_REQUEST['filtro'];

if ($q == "1" ) {
    $representantes = $representanteCompania->mostrarContactos();
    
    foreach ($representantes as &$valor) {
        echo '<input id="contactos_boxes" type="checkbox" name="contacto[]" value="'.
                $valor[0].
                '"/>'.
                $valor[3].
                '<br />';
    }
} else {
    $representanteCompania->setNombre($q);
    $representantes = $representanteCompania->mostrarContactoPorNombre();
    
    foreach ($representantes as &$valor) {
        echo '<input id="contactos_boxes" type="checkbox" name="contacto[]" value="'.
                $valor[0].
                '"/>'.
                $valor[3].
                '<br />';
    }
}