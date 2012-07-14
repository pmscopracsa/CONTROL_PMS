<?php
require_once '../../../dl/contacto_bl/Usuarios_Sistema.php';
$usuarios_sistema = new Usuarios_Sistema();

$q = $_REQUEST['filtro'];

if ($q == "1") {
    $usuarios = $usuarios_sistema->mostrarUsuarios();
    foreach ($usuarios as &$valor) {
        echo '<input id="usuarios_boxes" type="checkbox" name="usuarios_sistema[]" value="'.
                $valor[0].
                '"/>'.
                $valor[2].
                '<br />';
    }
} else {
    $usuarios_sistema->set_nombre($q);
    $usuarios = $usuarios_sistema->mostrarUsuariosPorNombre();
    foreach ($usuarios as &$valor) {
        echo '<input id="usuarios_boxes" type="checkbox" name="usuarios_sistema[]" value="'.
                $valor[0].
                '"/>'.
                $valor[2].
                '<br />';
    }
}