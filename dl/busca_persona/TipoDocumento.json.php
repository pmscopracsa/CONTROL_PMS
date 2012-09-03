<?php
require_once '../Conexion.php';

try {
    $conexion = new Conexion();
    $link_identifier = $conexion->conectar();
    
    if ( !$link_identifier )
        throw new Exception("Problemas al conectar");
    

    $query = "";
    
    $result = mysql_query($query, $link_identifier);
    
    if ( !$result )
        throw new Exception("Error en la consulta");
    
    $datos = array();
    $i = 0;
    while ($res = mysql_fetch_assoc($result)) { 
        $datos[$i]['direccion'] = $res['direccion']; 
        $datos[$i]['pais'] = $res['pais'];
        $datos[$i]['idpais'] = $res['idpais'];
        $datos[$i]['departamento'] = $res['departamento'];
        $datos[$i]['iddepartamento'] = $res['iddepartamento'];
        $datos[$i]['distrito'] = $res['distrito'];
        $datos[$i]['iddistrito'] = $res['iddistrito'];
        $datos[$i]['tipodireccion'] = $res['tipodireccion'];
        $datos[$i]['idtipodireccion'] = $res['idtipodireccion'];
        $datos[$i]['iddcc'] = $res['iddcc'];
        $i++;
    }
    echo json_encode($datos);
} catch ( Exception $ex ) {
    $ex->getMessage();
}