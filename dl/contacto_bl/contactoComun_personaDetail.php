<?php
require_once '../Conexion.php';
$conexion = new Conexion();
$cn = $conexion->conectar();

$id = $_GET['id'];
$sql = "SELECT id,nombres,correo FROM tb_personacontactocomun WHERE id=".$id." ORDER BY nombres ASC";
$result = mysql_query($sql) or die ("Error en la consulta: ".  mysql_error());

$i = 0;
$detalle = array();
while ($row = mysql_fetch_assoc($result)) {
    $detalle[$i]['id'] = $row[id] == NULL ? "<i>No tiene</i>" : $row[id];
    $detalle[$i]['nombres'] = $row[nombres] == NULL ? "<i>No tiene</i>" : $row[nombres];
    $detalle[$i]['correo'] = $row[correo] == NULL ? "<i>No tiene</i>" : $row[correo];
    $i++;
}
echo json_encode($detalle);
?>
