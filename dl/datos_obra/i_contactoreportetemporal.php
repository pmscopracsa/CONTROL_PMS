<?php
include_once 'Conexion.php';
$id_reporte = $_REQUEST['id_reporte'];
$id_contacto = $_REQUEST['id_contacto'];
$id_aleatorio = $_REQUEST['aleatorio'];

try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    if (!$cn) 
        throw new Exception ("Problemas en la conexion a la DDBB: ".  mysql_error());
    
    $sql = "INSERT INTO tb_contactoreportetemporal VALUES ($id_reporte, $id_contacto, $id_aleatorio)";
    $res = mysql_query($sql,$cn);
    
    if (!$res)
        throw new Exception("Problemas en la insercion de la data: ".  mysql_error());
} catch ( Exception $ex ) {
    echo "-> ".$ex->getMessage(); 
}