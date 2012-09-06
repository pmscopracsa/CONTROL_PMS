<?php
require_once '../Conexion.php';

$id = $_REQUEST['idpersona'];

try {
    $conexion = new Conexion();
    $link_identifier = $conexion->conectar();
    
    if ( !$link_identifier )
        throw new Exception("Problemas al conectar");
   
    $query = "SELECT id
        id
        ,direccion
        ,tb_pais_id idpais
        ,tb_departamento_id iddepartamento
        ,tb_distrito_id  iddistrito
        FROM tb_personacontacto
        WHERE dni = '$id'";
    
    $result = mysql_query($query, $link_identifier);
    
    if ( !$result )
        throw new Exception("Error en la consulta");
    
    $datos = array();
    $i = 0;
    while ($res = mysql_fetch_assoc($result)) { 
        $datos[$i]['direccion'] = $res['direccion']; 
        $datos[$i]['id'] = $res['id']; 
        $datos[$i]['idpais'] = $res['idpais'];
        $datos[$i]['iddepartamento'] = $res['iddepartamento'];
        $datos[$i]['iddistrito'] = $res['iddistrito'];
        $i++;
    }
    echo json_encode($datos);
} catch ( Exception $ex ) {
    $ex->getMessage();
}