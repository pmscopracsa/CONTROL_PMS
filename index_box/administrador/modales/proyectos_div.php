<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

require_once '../../../dl/Conexion.php';
require_once '../../../dl/ObraCliente.php';
$cnx = new Conexion();
$cn = $cnx->conectar();
$obrascliente = new ObraCliente();
$obrascliente->set_tb_empresa_id($_SESSION['id']);
$proyectos = $obrascliente->listarProyectos($cn);

echo '<div>';
foreach ($proyectos as $valor) {
    echo '<table><tr style="cursor:pointer;"><td class="proyecto"><p style="display:none">'.
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