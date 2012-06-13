<?php
//echo "DATOS:<br />"; 
//foreach ($_GET as $key => $value) {
//    echo $key ." => ". $value;
//}
include_once '../../../dl/Conexion.php';
include_once '../../../dl/consultas_comunes/Comun.php';

$comun = new Comun();
$tabla_cc = "tb_contactocomun";
$comun->set_nombreTabla($tabla_cc);
$comun->set_id(1); //row
$array = $comun->retornaTabla();

$array_temp = array();

while ($rs = mysql_fetch_assoc($array,MYSQL_ASSOC)) {
    array_push($array_temp['descripcion'],$rs['descripcion']);
    array_push($array_temp,$rs['ruc']);
    array_push($array_temp,$rs['email']);
    array_push($array_temp,$rs['web']);
    array_push($array_temp,$rs['observacion']);
    array_push($array_temp,$rs['nombreComercial']);
    array_push($array_temp,$rs['fax']);
    array_push($array_temp,$rs['partidaregistral']);
    array_push($array_temp,$rs['giro']);
    array_push($array_temp,$rs['actividadprincipal']);
}

//print_r($array_temp);
echo $array_temp['descripcion'];