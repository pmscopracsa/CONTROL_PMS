<?php
/**
 * SE ----- 
 */
include_once '../../dl/Conexion.php';
$conexion = new Conexion();
$link_identifier = $conexion->conectar();

$id = $_REQUEST['id'];

//$query = "SELECT * FROM tb_personacontacto WHERE id = $id";
$query = "SELECT pc.id id, pc.nombre nombre, cc.descripcion empresa
            FROM tb_personacontacto pc
            INNER JOIN tb_companiacontacto cc
            ON pc.tb_companiacontacto_id = cc.id
            WHERE pc.id = $id
            ORDER BY nombre ASC";

$result = mysql_query($query, $link_identifier);
$contacto_json = array();
$i = 0;

while ($res = mysql_fetch_assoc($result)) {
    $contacto_json[$i]['id'] = $res['id'];
    $contacto_json[$i]['nombre'] = $res['nombre'];
    $contacto_json[$i]['empresa'] = $res['empresa'];
    $i++;
}

echo json_encode($contacto_json);
?>