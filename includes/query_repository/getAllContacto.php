<?php
include_once '../../dl/Conexion.php';
$conexion = new Conexion();
$link_identifier = $conexion->conectar();

$id = $_REQUEST['id'];

$query = "SELECT * FROM EspecialidadCompania WHERE id = $id";
$result = mysql_query($query, $link_identifier);
$contacto_json = array();
$i = 0;
//while ($row = mysql_fetch_array($result)) {
//    $id_ = $row['id'];
//    $descripcion = $row['descripcion'];
//    echo "$id_\t";
//    echo $descripcion;
//}

while ($res = mysql_fetch_assoc($result)) {
    $contacto_json[$i]['id'] = $res['id'];
    $contacto_json[$i]['descripcion'] = $res['descripcion'];
    $i++;
}

echo json_encode($contacto_json);
?>