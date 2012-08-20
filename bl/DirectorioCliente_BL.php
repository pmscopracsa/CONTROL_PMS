<?php
require_once '../dl/Conexion.php';
require_once '../dl/DirectorioCliente.php';

$conexion = new Conexion();
$cn = $conexion->conectar();
$directorio = new DirectorioCliente();

if ($_REQUEST['parameter'] == 'crearDirectorio') {
    $directorio->set_nombre($_REQUEST['nombre']);
    $directorio->set_descripcion($_REQUEST['descripcion']);
    $directorio->set_tb_empresa_id($_REQUEST['id_empresa']);
    $directorio->crearDirectorio($cn);
}