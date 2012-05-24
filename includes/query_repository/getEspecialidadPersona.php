<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../../dl/Conexion.php';
$conexion = new Conexion();
$link_identifier = $conexion->conectar();

$id = $_REQUEST['id'];

$query = "SELECT * FROM tb_especialidadpersona WHERE id = $id";
$result = mysql_query($query,$link_identifier);
$especialidad_persona = array();
$i = 0;

while ($res = mysql_fetch_assoc($result)) {
    $especialidad_persona[$i]['id'] = $res['id'];
    $especialidad_persona[$i]['descripcion'] = $res['descripcion'];
    $i++;
}
echo json_encode($especialidad_persona);
?>
