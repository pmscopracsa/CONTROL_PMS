<?php
require_once '../../Conexion.php';
$conexion = new Conexion();
$cn = $conexion->conectar();

$id = $_GET['id'];
$sql = "SELECT 
    tm.numero numero
    FROM tb_personacontacto pc
    INNER JOIN tb_telefonomovilpersona tm ON pc.id = tb_personacontacto_id
    WHERE pc.id =".$id;
$result = mysql_query($sql,$cn) or die ("Error en la consulta: ".  mysql_error());

$i = 0;
$detalle = array();

while ($row = mysql_fetch_assoc($result)) {
    $detalle[$i]['numero'] = $row[numero];
    $i++;
}

echo json_encode($detalle);