<?php
require_once '../../../dl/contacto_bl/seteoOpciones/DirectoriosDL.php';
$directorioGeneral = new DirectoriosDL();

$q = $_REQUEST['filtro'];

if ($q == "1") {
    $directorios = $directorioGeneral->mostrarDirectorio();
    
    foreach ($directorios as &$valor) {
        echo '<table><tr style="cursor:pointer;"><td class="cliente">'.
        $valor[0].
        ' | '.
        $valor[1].        
        '</td></tr></table>';
    }
} else {
    $directorioGeneral->set_nombre($q);
    $directorios = $directorioGeneral->mostrarDirectorioPorNombre();
    
    foreach ($directorios as &$valor) {
        echo '<table><tr style="cursor:pointer;"><td class="cliente">'.
        $valor[0].
        ' | '.
        $valor[1].        
        '</td></tr></table>';
    }
}