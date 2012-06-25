<?php
include_once 'Conexion.php';

$aleatorio = $_REQUEST['aleatorio'];

try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    if (!$cn)
        throw new Exception("Problemas en la conexion a la DDBB: ".  mysql_error());
    
    $sql = "DELETE FROM temporal WHERE random_code = $aleatorio";
    $sql1 = "DELETE FROM tb_firmascontactotemporal WHERE aleatorio = $aleatorio";
    $res = mysql_query($sql,$cn);
    $res1 = mysql_query($sql1,$cn);
    
    if (!$res || $res1)
        throw new Exception("Problemas en el truncamiento de la tabla: ".  mysql_error());
} catch ( Exception $ex ) {
    echo "->".$ex->getMessage();
}