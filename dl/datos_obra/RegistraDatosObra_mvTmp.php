<?php
// Movemos los datos temporales a las tablas finales
require_once '../Conexion.php';
$aleatorio = $_REQUEST['aleatorio'];
$idobra = $_REQUEST['idobra'];

$contacto = "INSERT INTO tb_contacto(tb_personacontacto_id, tb_obra_id) 
             SELECT id_contacto,id_obra FROM temporal WHERE random_code = '$aleatorio'";

$firma = "INSERT INTO tb_firma (idcontacto,idobra,posicion)
            SELECT id_contacto,$idobra,txt_puesto FROM tb_firmascontactotemporal
            WHERE aleatorio = '$aleatorio'";

$reporte = "INSERT INTO tb_contactoreporte(tb_personacontacto_id,tb_reporte_id,tb_obra_id,posicion)
            SELECT id_contacto,id_reporte,$idobra,posicion FROM tb_contactoreportetemporal
            WHERE aleatorio = $aleatorio";

try {
    $cnx = new Conexion();
    $cn = $cnx->conectar();
    if (!$cn)       throw new Exception("Error al conectar: ".  mysql_error());
    
    $rs_contacto = mysql_query($contacto);
    if(!$rs_contacto)        throw new Exception("Error al consultar: ".  mysql_error());
    
    $rs_firma = mysql_query($firma);
    if (!$rs_firma)        throw new Exception("Error en la consultar: " .mysql_error());
    
    $rs_reporte = mysql_query($reporte);
    if (!$rs_reporte)        throw new Exception("Error en la consulta: ".  mysql_error());
    
} catch(Exception $ex) {
    echo 'Error: '.$ex->getMessage();
}