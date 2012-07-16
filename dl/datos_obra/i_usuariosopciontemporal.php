<?php
include_once 'Conexion.php';
$id_opcion = $_REQUEST['id_opcion'];
$id_usuario = $_REQUEST['id_usuario'];
$id_aleatorio = $_REQUEST['id_aleatorio'];

try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    if (!$cn) 
        throw new Exception ("Problemas en la conexion a la DDBB: ".  mysql_error());
    
    $sql = "INSERT INTO tb_usuariosopciontemporal(id_opcion, id_usuario,aleatorio) VALUES ($id_opcion, $id_usuario, $id_aleatorio)";
    $res = mysql_query($sql,$cn);
    
    if (!$res)
        throw new Exception("Problemas en la insercion de la data: ".  mysql_error());
} catch ( Exception $ex ) {
    echo "-> ".$ex->getMessage(); 
}