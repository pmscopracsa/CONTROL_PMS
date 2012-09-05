<?php
require_once '../../../dl/contacto_bl/RepresentanteCompaniaDL.php';
$contacto = new RepresentanteCompaniaDL();
$contactos = $contacto->mostrarRepresentantes();
echo '<div>';
echo '<div style:"float:left"><input type="text" id="txt_divContactoBuscar"/><input type="button" value="Buscar" id="btnSearchContacto" class="ui-button ui-widget ui-state-default ui-corner-all"></div>';
foreach ($contactos as $valor) {
    echo '<table><tr style="cursor:pointer;"><td class="contacto"><p style="display:none">'.
                $valor[0].
                '</p>'.
                '<p style="display:none">-</p>'.
                $valor[3].
                '</td></tr></table>';
}