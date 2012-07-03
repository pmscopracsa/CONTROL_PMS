<?php
include_once '../../../dl/Conexion.php';

$conectar = new Conexion();
$cn = $conectar->conectar();

$sql = "SELECT * FROM control_pms.tb_especialidadcompania ORDER BY id DESC LIMIT 1 ";
$rs = mysql_query($sql,$cn);

$especialidad = array();

while ($res = mysql_fetch_assoc($rs)) {
    $especialidad[$i]['id'] = $res['id'];
    $especialidad[$i]['descripcion'] = $res['descripcion'];
    $i++;
}
echo json_encode($especialidad);