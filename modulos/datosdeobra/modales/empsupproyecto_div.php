<?php
require_once '../../../dl/contacto_bl/CompaniaContactoDL.php';
$clienteCompania =  new CompaniaContactoDL();

$q = $_REQUEST['filtro'];

if ($q == "1") {
    $clientes = $clienteCompania->mostrarCompaniaContacto();
    echo '<div>';
    echo '<div  style:"float:left"><input type="text" id="txt_divEmpSupervisoraBuscar"/><input type="button" value="Buscar" id="btnSearchEmpSupervisora" class="ui-button ui-widget ui-state-default ui-corner-all"/></div>';
    foreach ($clientes as &$valor) {
        echo '<table><tr style="cursor:pointer;"><td class="supervisorproyecto"><p style="display:none">'.
                $valor[0].
                '</p>'.
                '<p style="display:none">-</p>'.
                $valor[1].
                '</td></tr></table>';
    }
    echo '</div>';
} else {
    $clienteCompania->setDescripcion($q);
    $clientes = $clienteCompania->mostrarCompaniaContactoPorNombre();
    echo '<div>';
    echo '<div  style:"float:left"><input type="text" id="txt_divEmpSupervisoraBuscar"/><input type="button" value="Buscar" id="btnSearchEmpSupervisora" class="ui-button ui-widget ui-state-default ui-corner-all"/></div>';
    foreach ($clientes as &$valor) { 
        echo '<table><tr style="cursor:pointer;"><td class="supervisorproyecto"><p style="display:none">'.
                $valor[0].
                '</p>'.
                '<p style="display:none">-</p>'.
                $valor[1].
                '</td></tr></table>';
    }
    echo '</div>';
}