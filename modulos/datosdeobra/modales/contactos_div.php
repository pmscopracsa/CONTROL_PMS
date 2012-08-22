<?php
require_once '../../../dl/contacto_bl/ContactoPersona.php';
$representanteCompania = new ContactoPersona();

$q = $_REQUEST['filtro'];

if ($q == "1" ) {
    $representantes = $representanteCompania->mostrarContactos();
    echo '<div>';
    echo '<div  style:"float:left"><input type="text" id="txt_divContactoBuscar"/><input type="button" value="Buscar" id="btnSearchContacto" class="ui-button ui-widget ui-state-default ui-corner-all"/></div>';
    foreach ($representantes as &$valor) {
        echo '<input id="contactos_boxes" type="checkbox" name="contacto[]" value="'.
                $valor[0].
                '"/>'.
                $valor[3].
                '<br />';
    }
    echo '</div>';
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