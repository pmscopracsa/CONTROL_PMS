<?php
require_once '../Conexion.php';

$ruc = $_REQUEST['ruc'];

$query = "SELECT id FROM tb_companiacontacto WHERE ruc = '$ruc'";
        
try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();

    if (!$cn) 
        throw new Exception("Error al conectar: ".mysql_error ());

    $sql = mysql_query($query,$cn);

    if (!$sql)
        throw new Exception("Error en consulta: ".  mysql_error());

    $rs = mysql_fetch_row($sql);
    echo $rs[0];
    
} catch (Exception $ex) {
    echo 'Error al consultar: '.$ex->getMessage();
}