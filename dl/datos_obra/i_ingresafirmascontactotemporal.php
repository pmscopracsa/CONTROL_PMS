<?php
include_once 'Conexion.php';
$id_contacto = $_REQUEST['id_contacto'];
$txt_puesto = $_REQUEST['puesto'];
$aleatorio = $_REQUEST['aleatorio'];

try  {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    if ( !$cn )
    throw new Exception("Problemas en la conexion a la DB: ".mysql_error());
    
    $sql = "INSERT INTO tb_firmascontactotemporal(id_contacto,txt_puesto,aleatorio) VALUES($id_contacto, '$txt_puesto','$aleatorio')";
    $res = mysql_query( $sql,$cn );
    
    if ( !$res )
        throw new Exception("Problemas en la insercion de la data a la tabla tb_firmascontactotemporal: ".  mysql_error());
} catch ( Exception $ex ) {
    echo $ex->getMessage();
}