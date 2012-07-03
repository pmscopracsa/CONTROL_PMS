<?php
/**
 *  ACTUALIZAR EL CAMPO POSICION_FIRMA_EN_REPORTE
 */
include_once 'Conexion.php';
$id_reporte = $_REQUEST['reporte'];
$id_contacto = $_REQUEST['id_contacto'];
$id_aleatorio = $_REQUEST['id_aleatorio'];
$posi_firma_reportes = $_REQUEST['posi_reporte'];

try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    if (!$cn) 
        throw new Exception ("Problemas en la conexion a la DDBB: ".  mysql_error());
    
    $sql = "UPDATE tb_contactoreportetemporal 
    SET posicion_firma_en_reporte = $posi_firma_reportes
    WHERE id_reporte = $id_reporte
    AND id_contacto = $id_contacto
    AND id_aleatorio = $id_aleatorio";
    
    $sql_tb_firmascontactotemporal = "UPDATE tb_firmascontactotemporal 
    SET estado_asignado = 's'
    ,reporte_id = $id_reporte
    WHERE id_contacto = $id_contacto 
    AND aleatorio = $id_aleatorio";
    
    $res = mysql_query($sql,$cn);
    $res2 = mysql_query($sql_tb_firmascontactotemporal,$cn);
    
    if (!$res || $res2)
        throw new Exception("Problemas en la insercion de la data: ".  mysql_error());
} catch ( Exception $ex ) {
    echo "-> ".$ex->getMessage(); 
}