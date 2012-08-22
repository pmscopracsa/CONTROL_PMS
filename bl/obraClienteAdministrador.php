<?php
require_once '../dl/Conexion.php';
require_once '../dl/ObraCliente.php';
$obra_cliente = new ObraCliente();

try {
    $conx = new Conexion();
    $cn = $conx->conectar();
    if (!$cn)
        throw new Exception("Error en conexion: ".  mysql_error());
    
    if ($_REQUEST['parameter'] == 'crearProyectoBasico') {
        $obra_cliente->set_codigoobra($_REQUEST['obracodificacion']);
        $obra_cliente->set_descripcion($_REQUEST['obranombre']);
        $obra_cliente->set_tb_directorio_id($_REQUEST['id_directorio']);
        $obra_cliente->set_tb_empresa_id($_REQUEST['id_empresa']);
        $obra_cliente->crearObraMinimo($cn);
    } elseif ($_REQUEST['parameter'] == 'editarProyectoBasico') {
        $obra_cliente->set_codigoobra($_REQUEST['codigoobra']);
        $obra_cliente->set_descripcion($_REQUEST['descripcion']);
        $obra_cliente->set_id($_REQUEST['idproyecto']);
        $obra_cliente->actualizarProyecto($cn);
    }
} catch(Exception $ex) {
    echo 'error: '.$ex->getMessage();
}
