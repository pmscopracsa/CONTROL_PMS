<?php
/**
 * Contacto comun - Empresa 
 * PAGIUNAS AMARILLAS
 */
require_once '../Conexion.php';
$conexion = new Conexion();
$cn = $conexion->conectar();

$page = $_GET['page'];
$limit = $_GET['rows'];
$sidx = $_GET['sidx'];
$sord = $_GET['sord'];

if(!$sidx) $sidx = 1;

$result = mysql_query("SELECT COUNT(*) AS count FROM tb_especialidadComun ORDER BY descripcion ASC");
$row = mysql_fetch_array($result,MYSQL_ASSOC);
$count = $row['count'];

if($count > 0){$total_pages = ceil($count/$limit);}
else{$total_pages = 0;}

if($page > $total_pages) $page = $total_pages;

$start = $limit * $page - $limit;

$SQL = "SELECT id,descripcion FROM tb_especialidadComun ORDER BY $sidx $sord LIMIT $start, $limit";
$result = mysql_query($SQL);

$responce = new stdClass();
$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;

$i = 0;
while($row = mysql_fetch_assoc($result)) {
    $responce->rows[$i]['id'] = $row['id'];
    $responce->rows[$i]['cell'] = array($row['id'],$row['descripcion']);
    $i++;
}
echo json_encode($responce);
?>