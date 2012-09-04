<?php
require_once '../../../dl/contacto_bl/EspecialidadPersonaDL.php';
$especialidadpersona = new EspecialidadPersonaDL();

$especialidades = $especialidadpersona->mostrarEspecialidades();
echo '<div>';
echo '<div style:"float:left"><input type="text" id="txt_divEspecialidadPersonaBuscar"/><input type="button" value="Buscar" id="btnSearchEspecialidad" class="ui-button ui-widget ui-state-default ui-corner-all"></div>';
foreach ($especialidades as $valor) {
    echo '<table><tr style="cursor:pointer;"><td class="especialidad"><p style="display:none">'.
                $valor[0].
                '</p>'.
                '<p style="display:none">-</p>'.
                $valor[1].
                '</td></tr></table>';
}