<?php
require_once '../../../dl/contacto_bl/CompaniaContactoDL.php';
$clienteCompania =  new CompaniaContactoDL();

$q = $_REQUEST['filtro'];

if ($q == "1") {
    $clientes = $clienteCompania->mostrarCompaniaContacto();
    
    foreach ($clientes as &$valor) {
        echo '<table><tr style="cursor:pointer;"><td class="cliente"><p style="display:none">'.
                $valor[0].
                '</p>'.
                '<p style="display:none">-</p>'.
                $valor[1].
                '</td></tr></table>';
    }
} else {
    $clienteCompania->setDescripcion($q);
    $clientes = $clienteCompania->mostrarCompaniaContactoPorNombre();
    
    foreach ($clientes as &$valor) { 
        echo '<table><tr style="cursor:pointer;"><td class="cliente"><p style="display:none">'.
                $valor[0].
                '</p>'.
                '<p style="display:none">-</p>'.
                $valor[1].
                '</td></tr></table>';
    }
}