<?php
include_once 'Conexion.php';

$aleatorio = $_REQUEST['aleatorio'];

try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    if (!$cn)
        throw new Exception("Problemas en la conexion a la DDBB: ".  mysql_error());
    
    $sql = "DELETE FROM temporal WHERE random_code = $aleatorio";
    $res = mysql_query($sql,$cn);
    if (!$res)
        throw new Exception("Problemas en el truncamiento de la tabla: ".  mysql_error());
} catch ( Exception $ex ) {
    echo "->".$ex->getMessage();
}