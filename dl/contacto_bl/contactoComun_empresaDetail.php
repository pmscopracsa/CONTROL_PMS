<?php
require_once '../Conexion.php';
$conexion = new Conexion();
$cn = $conexion->conectar();

$id = $_GET['id'];
//$sql = "SELECT descripcion,ruc FROM tb_contactocomun WHERE id =".$id." ORDER BY descripcion ASC";

$sql = "SELECT a.descripcion,b.descripcion descr,a.ruc,a.observacion,a.email,a.web 
FROM control_pms.tb_companiacontacto a
INNER JOIN tb_tipocompania b
ON a.tb_tipocompania_id = b.id
WHERE a.id = ".$id;
$result = mysql_query($sql) or die ("Error en la consulta:".  mysql_error());

$i = 0;
$detalle = array();
while($row = mysql_fetch_assoc($result))
{
    /*$detalle[$i]['descripcion'] = $row[descripcion] == NULL ? "<i>No tiene</>" : $row[descripcion];
    $detalle[$i]['ruc'] = $row[ruc] == NULL ? "<i>No tiene</i>" : $row[ruc];*/
    
    $detalle[$i]['descripcion'] = $row[descripcion] == NULL ? "<i>No tiene</i>" : $row[ruc];
    $detalle[$i]['descr'] = $row[descr] == NULL ? "<i>No tiene</i>" : $row[ruc];
    $detalle[$i]['ruc'] = $row[ruc] == NULL ? "<i>No tiene</i>" : $row[ruc];
    $detalle[$i]['observacion'] = $row[observacion] == NULL ? "<i>No tiene</i>" : $row[ruc];
    $detalle[$i]['email'] = $row[email] == NULL ? "<i>No tiene</i>" : $row[ruc];
    $detalle[$i]['web'] = $row[web] == NULL ? "<i>No tiene</i>" : $row[ruc];
    $i++;
}
echo json_encode($detalle);
?>
