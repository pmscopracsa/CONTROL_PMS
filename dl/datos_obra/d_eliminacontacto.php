<?php
include_once 'Conexion.php';
$accion = $_REQUEST['accion'];
$id = $_REQUEST['id'];
$aleatorio = $_REQUEST['aleatorio'];

try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    if (!$cn)
        throw new Exception("Problemas en la conexion a la DDBB: ".  mysql_error());
    
    switch ($accion) {
        case 1:
            $sql = "SELECT COUNT(*) FROM tb_firmascontactotemporal WHERE id_contacto = $id AND aleatorio = $aleatorio";
            $res = mysql_query($sql,$cn);
            $res = mysql_fetch_array($res);
            echo $res[0];
            break;
        case 2:
            $sql = "DELETE FROM temporal WHERE id_contacto=$id AND random_code = $aleatorio";
            $res = mysql_query($sql,$cn);
        default:
            break;
    }
    
    if (!$res)
        throw new Exception("Problemas en la eliminacion de la data: ".  mysql_error());
} catch (Exception $ex) {
    echo "->".$ex->getMessage();
}