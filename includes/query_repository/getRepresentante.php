<?php
/**
 * tabla: tb_personacontacto
 * modulo: Busca Persona 
 * formulario: Registro de compania
 */

include_once '../../dl/Conexion.php';
$conexion = new Conexion();
$link_identifier = $conexion->conectar();

$id = $_REQUEST['id'];

$query = "SELECT * FROM tb_personacontacto WHERE id = $id";
$result = mysql_query($query,$link_identifier);
$representante = array();
$i = 0;

while($res = mysql_fetch_assoc($result)) {
    $representante[$i]['id'] = $res['id'];
    $representante[$i]['dni'] = $res['dni'] == NULL ? "------" : $res['dni'];
    $representante[$i]['nombre'] = $res['nombre'] === NULL ? "------" : $res['nombre'];
    $representante[$i]['cargo'] = $res['cargo'] === NULL ? "------" : $res['cargo'];
    $representante[$i]['fax'] = $res['fax'] === NULL ? "------" : $res['fax'];
    $representante[$i]['email'] = $res['email'] === NULL ? "------" : $res['email'];
    $i++;
}
echo json_encode($representante);
/**
 * todo: telefonos (fijo - movil) 
 */
?>