<?php
require_once '../Conexion.php';
$conexion = new Conexion();
$cn = $conexion->conectar();

$id = $_GET['id'];
$sql = "SELECT 
    tn.numero numero
    FROM tb_personacontactocomun pcc
    INNER JOIN tb_comuntnextel tn ON  pcc.id = tn.tb_personacontactocomun_id
    WHERE pcc.id=".$id;
$result = mysql_query($sql,$cn) or die ("Error en la consulta: ".  mysql_error());

$i = 0;
$detalle = array();

while ($row = mysql_fetch_assoc($result)) {
    $detalle[$i]['numero'] = $row['numero'];
    $i++;
}

echo json_encode($detalle);