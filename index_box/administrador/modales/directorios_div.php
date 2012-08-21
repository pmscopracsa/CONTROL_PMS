<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
require_once '../../../dl/DirectorioCliente.php';
require_once '../../../dl/Conexion.php';
$directorio = new DirectorioCliente();
$conexion = new Conexion();
$cn = $conexion->conectar();

$directorio->set_tb_empresa_id($_SESSION['id']);
$directorios = $directorio->listarDirectorios($cn);

echo '<div>';

foreach ($directorios as &$valor) {
    echo '<table><tr style="cursor:pointer;"><td class="directorio"><p style="display:none">'.
        $valor[0].
        '</p>'.
        '<p style="display:none">-</p>'.    
        '<p style="display:none">'.
        $valor[1].    
        '</p>'.    
        '<p style="display:none">-</p>'.
        $valor[2].
        '</td></tr></table>';
}
echo '</div>';