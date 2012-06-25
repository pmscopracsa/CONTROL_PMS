<?php
include_once 'Conexion.php';

try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    if (!$cn) 
        throw new Exception("Problemas en la conexion: ".  mysql_error());
    
    $sql = "SELECT * FROM tb_reportes";
    $res = mysql_query($sql);
    
    if (!$res) 
        throw new Exception("Problemas en la consulta: ".  mysql_error());
    
    $reportes = array();
    $i = 0;
    while ($rs = mysql_fetch_assoc($res)) {
        $reportes[$i]['id'] = $rs['id'];
        $reportes[$i]['descripcion'] = $rs['descripcion'];
        $i++;
    }
    echo json_encode($reportes);
} catch (Exception $ex) {
    echo $ex->getMessage();
}