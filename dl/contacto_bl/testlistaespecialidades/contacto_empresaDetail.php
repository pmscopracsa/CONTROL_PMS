<?php
require_once '../../Conexion.php';
$conexion = new Conexion();
$cn = $conexion->conectar();

$id = $_GET['id'];
$sql = "SELECT descripcion,ruc FROM tb_companiacontacto WHERE id =".$id." ORDER BY descripcion ASC";
$result = mysql_query($sql,$cn) or die ("Error en la consulta:".  mysql_error());

$i = 0;
$detalle = array();
while($row = mysql_fetch_assoc($result))
{
    $detalle[$i]['descripcion'] = $row[descripcion] == NULL ? "<i>No tiene</>" : $row[descripcion];
    $detalle[$i]['ruc'] = $row[ruc] == NULL ? "<i>No tiene</i>" : $row[ruc];
    $i++;
}
echo json_encode($detalle);
?>
