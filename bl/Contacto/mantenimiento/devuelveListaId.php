<?php
require_once '../../../dl/Conexion.php';
$cnx = new Conexion();
$cn = $cnx->conectar();

$q = $_REQUEST['nombrelista'];

$rs = mysql_query("SELECT * FROM tb_listadistribucioncontacto WHERE descripcion = '$q'");

$jsondata = array();
$i = 0;
while($row = mysql_fetch_assoc($rs)) {
    $jsondata[$i]['id'] = $row['id'];
    $i++;
}
echo json_encode($jsondata);