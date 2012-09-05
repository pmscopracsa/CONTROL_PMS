<?php
require_once '../../../dl/contacto_bl/EspecialidadCompaniaDL.php';
$especialidad = new EspecialidadCompaniaDL();
$especialidades = $especialidad->mostrarEspecialidades();
echo '<div>';
echo '<div style:"float:left"><input type="text" id="txt_divEspecialidadBuscar"/><input type="button" value="Buscar" id="btnSearchEspecialidad" class="ui-button ui-widget ui-state-default ui-corner-all"></div>';
foreach ($especialidades as $valor) {
    echo '<table><tr style="cursor:pointer;"><td class="especialidad"><p style="display:none">'.
                $valor[0].
                '</p>'.
                '<p style="display:none">-</p>'.
                $valor[1].
                '</td></tr></table>';
}