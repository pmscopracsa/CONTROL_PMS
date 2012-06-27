<?php
include_once 'Conexion.php';
$id = $_REQUEST['codigo'];
$aletorio = $_REQUEST['aleatorio'];
$posicion = $_REQUEST['posicion'];

try  {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    if ( !$cn )
    throw new Exception("Problemas en la conexion a la DB: ".mysql_error());
    
    $sql = "UPDATE tb_firmascontactotemporal SET txt_puesto = '$posicion' WHERE id_contacto = $id AND aleatorio = '$aletorio'";
    $res = mysql_query( $sql,$cn );
    
    if ( !$res )
        throw new Exception("Problemas en la insercion de la data: ".  mysql_error());
} catch ( Exception $ex ) {
    echo $ex->getMessage();
}