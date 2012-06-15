<?php
require_once '../Conexion.php';
$conexion = new Conexion();
$conexion->conectar();

$id = $_GET['id'];

$sql = "SELECT 
    tm.numero 
    FROM tb_personacontactocomun pcc
    INNER JOIN tb_comuntmobile tm ON  pcc.id = tm.tb_personacontactocomun_id
    WHERE pcc.id=".$id;

$result = mysql_query($sql) or die ("Error en la consulta:".mysql_error());

$i = 0;
$telefonos = array();
while ($row = mysql_fetch_assoc($result))
{
    $telefonos[$i]['numero'] = $row[numero];
    $i++;
    echo "";
}
echo json_encode($telefonos);