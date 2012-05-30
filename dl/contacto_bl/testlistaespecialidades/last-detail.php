<?php
require_once '../Conexion.php';
$conexion = new Conexion();
$cn = $conexion->conectar();

$id = $_GET['id'];
$sql = "SELECT nombre, dni, cargo, fax, email, web FROM tb_personacontacto WHERE id = ".$id;
$result = mysql_query( $sql ) or die("Error en la consulta.".mysql_error()); 
//
$i = 0;
//mysql_fetch_assoc($result)
$detalle = array();
while($row = mysql_fetch_assoc($result))
{
    $detalle[$i]['nombre'] = $row[nombre];
    $detalle[$i]['dni'] = $row[dni];
    $detalle[$i]['cargo'] = $row[cargo];
    $detalle[$i]['fax'] = $row[fax];
    $detalle[$i]['email'] = $row[email];
    $detalle[$i]['web'] = $row[web];
    $i++;
}
echo json_encode($detalle);
?>