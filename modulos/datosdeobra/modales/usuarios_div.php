<?php
require_once '../../../dl/contacto_bl/Usuarios_Sistema.php';
require_once '../../../dl/ObraCliente.php';
$usuarios_sistema = new Usuarios_Sistema();
$obra_cliente = new ObraCliente();

$q = $_REQUEST['filtro'];

if ($q == "1") {
    //echo '<table border="1"><thead><th>USUARIOS</th><th>CAMBIAR ID</th><th>MODIFICAR TOTAL ESTIMADO POR COSTO GENERAL</th><th>MODIFICAR ORDENES</th><th>APROBAR NUEVO TOTAL ESTIMADO</th><th>ELIMINAR DOCUMENTOS REGISTRADOS</th></thead>';
    $usuarios = $usuarios_sistema->mostrarUsuarios();
    foreach ($usuarios as &$valor) {
        echo '<input id="listausuarios" type="checkbox" name="listarusuarios[]" value="'.
                $valor[0].
                '"/>'.
                $valor[2].
                '<br />';
    }
}elseif ($q == "2") {
    $obras = $obra_cliente->cargarObras();
    echo '<label for="obra">Selecciona obra:</label>';
    echo '<select>';
    echo '<option value="0">Seleccione una obra</option>';
    foreach ($obras as $key => $value) {
        echo "<option value=\"$key\">$value</option>";
    }
    echo '</select>';
    echo '<div id="tipodireccionid"></div>';
    echo '<table border="1"><thead><th>USUARIOS</th><th>Seleccion</th></thead>';
    $usuarios = $usuarios_sistema->mostrarUsuarios();
    foreach ($usuarios as &$valor) {
        echo '<tr><td>';
        echo '<p style="display:none;">'.$valor[0].'"</p>'.$valor[2].'</td>';
        echo '<td align="center"><input id="chkSeleccionaUsuario" name="chkSeleccionaUsuario" type="checkbox" /></td>';
        echo '</tr>';
    }
    echo '<table>';
} 

else {
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