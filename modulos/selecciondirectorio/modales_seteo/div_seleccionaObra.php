<?php
require_once '../../../dl/contacto_bl/seteoOpciones/ObrasDL.php';
$obrasGeneral = new ObrasDL();

$q = $_REQUEST['filtro'];
$obrasGeneral->set_idEmpresa($_REQUEST['idEmpresa']);
$obrasGeneral->set_idDirectorio($_REQUEST['idDirectorio']);

if ($q == "1") {
    $obras = $obrasGeneral->mostrarObras();
    
    foreach ($obras as &$valor) 
    {
        echo '<table><tr style="cursor:pointer;"><td class="obra">
        <p style="display:none">'.$valor[0]." | </p>".
        $valor[1].
        ' | '.
        $valor[2].        
        '<p style="display:none"> | '.$valor[3]."</p>".        
        '</tr></table>';        
    }
} 
else 
{
    $obrasGeneral->set_descripcion($q);
    $obras = $obrasGeneral->mostrarObrasPorNombre();
    
    foreach ($obras as &$valor) 
    {
        echo '<table><tr style="cursor:pointer;"><td class="obra">'.
        $valor[0].
        ' | '.        
        $valor[1].
        ' | '.
        $valor[2].
        '</td></tr></table>';        
    }
}