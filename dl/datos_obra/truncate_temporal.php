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
    $sql2 = "DELETE FROM tb_contactoreportetemporal WHERE id_aleatorio = $aleatorio"; 
    $sql3 = "DELETE FROM tb_reportecontactoposicionfirmatemporal WHERE id_aleatorio = $aleatorio";
    $sql4 = "DELETE FROM tb_usuariosaprobaciontemporal WHERE aleatorio = $aleatorio";
    $sql5 = "DELETE FROM tb_usuariosopciontemporal WHERE aleatorio = $aleatorio";    
    $res = mysql_query($sql,$cn);
    $res1 = mysql_query($sql1,$cn);
    $res2 = mysql_query($sql2,$cn);
    $res4 = mysql_query($sql4, $cn);
    $res5 = mysql_query($sql5,$cn);
    
    if (!$res || !$res1 || !$res2 || !$res4 || !$res5)
        throw new Exception("Problemas en el truncamiento de la tabla: ".  mysql_error());
} catch ( Exception $ex ) {
    echo "->".$ex->getMessage();
}