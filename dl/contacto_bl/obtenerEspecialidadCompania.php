<?php
include_once 'Conexion.php';
$conexion = new Conexion();
$cn = $conexion->conectar();

$query = "SELECT * FROM tb_especialidadcompania";
$rs = mysql_query($query,$cn);
$registros = array();
$i = 0;
while ($res = mysql_fetch_assoc($rs)) {
    $registros[$i]['id'] = $res['id'];
    $registros[$i]['descripcion'] = $res['descripcion'];
    $i++;
}
mysql_free_result($rs);
mysql_close($cn);

return json_encode($registros);   
?>