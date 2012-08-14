<?php
require_once '../../../dl/contacto_bl/Usuarios_Sistema.php';
$usuarios_sistema = new Usuarios_Sistema();

$q = $_REQUEST['filtro'];

if ($q == "1") {
    echo '<table border="1"><thead><th>USUARIOS</th><th>CAMBIAR ID</th><th>MODIFICAR TOTAL ESTIMADO POR COSTO GENERAL</th><th>MODIFICAR ORDENES</th><th>APROBAR NUEVO TOTAL ESTIMADO</th><th>ELIMINAR DOCUMENTOS REGISTRADOS</th></thead>';
    $usuarios = $usuarios_sistema->mostrarUsuarios();
    foreach ($usuarios as &$valor) {
        echo '<tr><td>';
        echo '<p style="display:none;">'.$valor[0].'"</p>'.$valor[2].'</td>';
        for ($i=1;$i<=5;$i++)
            echo '<td align="center"><input id="chk_cambiarid" type="checkbox" /></td>';
        //echo '</td><td align="center"><input id="chk_cambiarid" type="checkbox" /></td><td align="center"><input type="checkbox" id="chk_cambiarid" /></td><td align="center"><input type="checkbox" id="chk_cambiarid" /></td><td align="center"><input type="checkbox" id="chk_cambiarid"/></td><td align="center"><input type="checkbox" id="chk_cambiarid"/></td>
        echo '</tr>';
    }
    echo '<table>';
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