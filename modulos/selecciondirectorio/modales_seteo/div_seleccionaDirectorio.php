<?php
require_once '../../../dl/contacto_bl/seteoOpciones/DirectoriosDL.php';
$directorioGeneral = new DirectoriosDL();

$q = $_REQUEST['filtro'];
$directorioGeneral->set_idEmpresa($_REQUEST['idEmpresa']);

if ($q == "1") {
    $directorios = $directorioGeneral->mostrarDirectorio();
    
    foreach ($directorios as &$valor) {
        echo '<table>
            <tr style="cursor:pointer;">
            <td class="directorio"><p style="display:none">'.
            $valor[0]." | </p>".
            $valor[1].      
            ' | '.        
            $valor[2].        
            '</td>
            </tr>
            </table>';
    }
} else {
    $directorioGeneral->set_nombre($q);
    $directorios = $directorioGeneral->mostrarDirectorioPorNombre();
    
    foreach ($directorios as &$valor) {
        echo '<table>
            <tr style="cursor:pointer;">
            <td class="directorio">'.
            $valor[0].
            ' | '.
            $valor[1].        
            '</td>
            </tr>
            </table>';
    }
}