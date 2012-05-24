<?php
include_once '../../dl/Conexion.php';
$conexion = new Conexion();
$link_identifier = $conexion->conectar();

$id = $_REQUEST['id'];

$query = "SELECT * FROM tb_personacontacto WHERE id = $id";
$result = mysql_query($query, $link_identifier);
$contacto_json = array();
$i = 0;

while ($res = mysql_fetch_assoc($result)) {
    $contacto_json[$i]['id'] = $res['id'];
    $contacto_json[$i]['nombre'] = $res['nombre'];
    $i++;
}

echo json_encode($contacto_json);
?>