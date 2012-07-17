<?php
include_once 'Conexion.php';
$id = $_REQUEST['id'];
$aleatorio = $_REQUEST['aleatorio'];

try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    if (!$cn)
        throw new Exception("Problemas en la conexion a la DDBB: ".  mysql_error());
    
    $sql = "DELETE FROM tb_usuariosaprobaciontemporal WHERE tb_usuario_id = $id AND aleatorio = $aleatorio";
    $res = mysql_query($sql,$cn);
    
    if (!$res)
        throw new Exception("Problemas en la eliminacion de la data: ".  mysql_error());
} catch (Exception $ex) {
    echo "->".$ex->getMessage();
}