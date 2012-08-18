<?php
require_once '../Conexion.php';
$conexion = new Conexion();
$cn = $conexion->conectar();

$id = $_GET['id'];
/*
$sql = "SELECT a.descripcion,b.descripcion descr,a.ruc,a.observacion,a.email,a.web 
FROM control_pms.tb_companiacontacto a
INNER JOIN tb_tipocompania b
ON a.tb_tipocompania_id = b.id
WHERE a.id = ".$id;
*/
$sql = "SELECT 
    a.id
    ,a.descripcion
    ,a.ruc
    ,a.observacion
    ,a.email
    ,a.web
    ,a.nombreComercial
    ,a.fax
    FROM control_pms.tb_contactocomun a
    WHERE a.id = ".$id;

$result = mysql_query($sql) or die ("Error en la consulta:".  mysql_error());

$i = 0;
$detalle = array();
while($row = mysql_fetch_assoc($result))
{
    /*$detalle[$i]['descripcion'] = $row[descripcion] == NULL ? "<i>No tiene</>" : $row[descripcion];
    $detalle[$i]['ruc'] = $row[ruc] == NULL ? "<i>No tiene</i>" : $row[ruc];*/
    
    $detalle[$i]['id'] = $row['id'];
    $detalle[$i]['descripcion'] = $row['descripcion'] == NULL ? "<i><b>No est&aacute; especificado</b></i>" : $row['descripcion'];
    $detalle[$i]['ruc'] = $row['ruc'] == NULL ? "<i><b>No est&aacute; especificado</b></i>" : $row['ruc'];
    $detalle[$i]['observacion'] = $row['observacion'] == NULL ? "<i><b>No est&aacute; especificado</b></i>" : $row['observacion'];
    $detalle[$i]['email'] = $row['email'] == NULL ? "<i><b>No est&aacute; especificado</b></i>" : $row['email'];
    $detalle[$i]['web'] = $row['web'] == NULL ? "<i><b>No est&aacute; especificado</b></i>" : $row['web'];
    $detalle[$i]['nombreComercial'] = $row['nombreComercial'] == NULL ? "<i><b>No est&aacute; especificado</b></i>" : $row['nombreComercial'];
    $i++;
}
echo json_encode($detalle);