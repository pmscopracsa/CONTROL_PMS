<?php
require_once '../Conexion.php';
$conexion = new Conexion();
$cn = $conexion->conectar();

$id = $_GET['id'];
$sql = "SELECT 
    id
    ,nombres
    ,correo 
    ,cargo
    FROM tb_personacontactocomun WHERE id=".$id." ORDER BY nombres ASC";
$result = mysql_query($sql) or die ("Error en la consulta: ".  mysql_error());

$i = 0;
$detalle = array();

while ($row = mysql_fetch_assoc($result)) {
    $detalle[$i]['id'] = $row[id] == NULL ? "<i><b>No est&aacute; especificado</b></i>" : $row[id];
    $detalle[$i]['nombres'] = $row[nombres] == NULL ? "<i><b>No est&aacute; especificado</b></i>" : $row[nombres];
    $detalle[$i]['correo'] = $row[correo] == NULL ? "<i><b>No est&aacute; especificado</b></i>" : $row[correo];
    $detalle[$i]['cargo'] = $row[cargo] == NULL ? "<i><b>No est&aacute; especificado</b></i>" : $row[cargo];
    $i++;
}


echo json_encode($detalle);