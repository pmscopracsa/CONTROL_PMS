<?php
/**
 *no esw clase porque solo muestra los detalles
 * se convertira en clase si el requrimeinto va por el lado
 * de tener una edicion in-line 
 */
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
    $detalle[$i]['nombre'] = $row[nombre] == NULL ? "<i>No tiene</i>" : $row[nombre];
    $detalle[$i]['dni'] = $row[dni] == NULL ? "<i>No tiene</i>" : $row[dni];
    $detalle[$i]['cargo'] = $row[cargo] == NULL ? "<i>No tiene</i>" : $row[cargo];
    $detalle[$i]['fax'] = $row[fax] == NULL ? "<i>No tiene</i>" : $row[fax];
    $detalle[$i]['email'] = $row[email] == NULL ? "<i>No tiene</i>" : $row[email];
    $detalle[$i]['web'] = $row[web] == NULL ? "<i>No tiene</i>" : $row[web];
    $i++;
}
echo json_encode($detalle);
?>