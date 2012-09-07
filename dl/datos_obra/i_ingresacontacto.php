<?php
include_once 'Conexion.php';
$idcontacto = $_REQUEST['idcontacto'];
$idobra = $_REQUEST['idobra'];

$aleatorio = $_REQUEST['aleatorio'];

try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    if (!$cn) 
        throw new Exception ("Problemas en la conexion a la DDBB: ".  mysql_error());
    
    $sql = "INSERT INTO temporal (id_contacto,id_obra,random_code) VALUES ($idcontacto, $idobra, $aleatorio)";
    $res = mysql_query($sql,$cn);
    
    if (!$res)
        throw new Exception("Problemas en la insercion de la data: ".  mysql_error());
} catch ( Exception $ex ) {
    echo "-> ".$ex->getMessage(); 
}