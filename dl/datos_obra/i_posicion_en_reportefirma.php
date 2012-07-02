<?php
// Ubicacion numerica de donde estara la posicion
include_once 'Conexion.php';

$id_contacto = $_REQUEST['id_contacto'];
$id_reporte = $_REQUEST['reporte'];
$id_aleatorio = $_REQUEST['aleatorio'];
$posicion = $_REQUEST['posi_reporte'];

try  {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    if ( !$cn )
    throw new Exception("Problemas en la conexion a la DB: ".mysql_error());
    
    $sql = "INSERT INTO tb_reportecontactoposicionfirmatemporal VALUES($id_contacto,$id_reporte,$id_aleatorio,'$posicion')";
    $res = mysql_query( $sql,$cn );
    
    if ( !$res )
        throw new Exception("Problemas en la insercion de la data: ".  mysql_error());
} catch ( Exception $ex ) {
    echo $ex->getMessage();
}