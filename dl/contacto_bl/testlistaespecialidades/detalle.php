<?php

require_once '../Conexion.php';
$conexion = new Conexion();
$cn = $conexion->conectar();

$examp = $_GET["q"];
$id = $_GET['id'];

$sql = "SELECT id,nombre FROM tb_personacontacto WHERE tb_companiacontacto_id =".$id;
$result = mysql_query($sql)or die("No se pudo ejecutar la consulta:".  mysql_error());

if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) { 
    header("Content-type: application/xhtml+xml;charset=utf-8"); 
} else { 
    header("Content-type: text/xml;charset=utf-8"); 
} 
$et = ">"; 
echo "<?xml version='1.0' encoding='utf-8'?$et\n"; 
echo "<rows>";

while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
    echo "<row>"; 
    echo "<cell>". $row[id]."</cell>"; 
    echo "<cell><![CDATA[". $row[nombre]."]]></cell>"; 
    echo "</row>";
} 
echo "</rows>"; 
?>