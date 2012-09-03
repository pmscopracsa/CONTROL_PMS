<?php
require_once '../Conexion.php';

try {
    $conexion = new Conexion();
    $link_identifier = $conexion->conectar();
    
    if ( !$link_identifier )
        throw new Exception("Problemas al conectar");
    
    $nombre = $_REQUEST['nombre'];
    
    $query = "SELECT 
            id 
            ,dni
            ,nombre
            ,cargo
            ,fax
            ,observacion
            ,email
            ,web
            ,direccion
            FROM 
            tb_personacontacto
            WHERE nombre = '$nombre'";
    
    $result = mysql_query($query, $link_identifier);
    
    if ( !$result )
        throw new Exception("Error en la consulta");
    
    $datos = array();
    $i = 0;
    while ($res = mysql_fetch_assoc($result)) { 
        $datos[$i]['id'] = $res['id']; 
        $datos[$i]['dni'] = $res['dni'];
        $datos[$i]['nombre'] = $res['nombre'];
        $datos[$i]['cargo'] = $res['cargo'];
        $datos[$i]['fax'] = $res['fax'];
        $datos[$i]['observacion'] = $res['observacion'];
        $datos[$i]['email'] = $res['email'];
        $datos[$i]['web'] = $res['web'];
        $datos[$i]['direccion'] = $res['direccion'];
        $i++;
    }
    echo json_encode($datos);
} catch ( Exception $ex ) {
    $ex->getMessage();
}