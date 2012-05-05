<?php
require_once 'Conexion.php';
$conexion  = new Conexion();
$cn = $conexion->conectar();

$parameter = strtolower($_GET['q']);
if (!$parameter) return;

$sql = "SELECT * FROM EspecialidadCompania WHERE descripcion LIKE '%$parameter%'";

$res = mysql_query($sql);

while ($row = mysql_fetch_array($res)) {
    $desc = $row['descripcion'];
    echo "$desc\n";
}

?>
