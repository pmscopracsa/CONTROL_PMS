<?php
include_once 'Conexion.php';
$id = $_REQUEST['id'];

try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    if (!$cn)
        throw new Exception("Problemas en la conexion a la DDBB: ".  mysql_error());
    
    $sql = "DELETE FROM temporal WHERE id_contacto=$id";
    $res = mysql_query($sql,$cn);
    
    if (!$res)
        throw new Exception("Problemas en la eliminacion de la data: ".  mysql_error());
} catch (Exception $ex) {
    echo "->".$ex->getMessage();
}