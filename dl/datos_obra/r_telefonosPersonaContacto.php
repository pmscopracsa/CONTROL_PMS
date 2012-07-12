<?php
include_once 'Conexion.php';
/**
 * FIJO = 1, MOBILE = 2, NEXTEL = 3 
 */
$tipotelefono = $_REQUEST['tipotelefono'];
$id_contacto = $_REQUEST['id_contacto'];

try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    if (!$cn) 
        throw new Exception("Problemas en la conexion: ".  mysql_error());
    
    switch ($tipotelefono) {
        case "1":
            $query = "SELECT numero FROM tb_telefonofijopersona WHERE tb_personacontacto_id = $id_contacto";
            $res = mysql_query($query);
            break;
        case "2":
            $query = "SELECT numero FROM tb_telefonomovilpersona WHERE tb_personacontacto_id = $id_contacto";
            $res = mysql_query($query);
            break;
        case "3":
            $query = "SELECT numero FROM tb_telefononextelpersona WHERE tb_personacontacto_id = $id_contacto";
            $res = mysql_query($query);
            break;
    } 
    
    if (!$res) 
        throw new Exception("Problemas en la consulta: ".  mysql_error());
    
    $telefonos = array();
    $i = 0;
    while ($rs = mysql_fetch_assoc($res)) {
        $telefonos[$i]['numero'] = $rs['numero'];
        $i++;
    }
    echo json_encode($telefonos);
} catch (Exception $ex) {
    echo $ex->getMessage();
}