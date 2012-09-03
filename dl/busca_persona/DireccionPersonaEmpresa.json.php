<?php
require_once 'Conexion.php';

$id = $_REQUEST['idpersona'];

try {
    $conexion = new Conexion();
    $link_identifier = $conexion->conectar();
    
    if ( !$link_identifier )
        throw new Exception("Problemas al conectar");
   
    $query = "SELECT 
        dcc.id direccion_id
        ,dcc.direccion direccion
        ,dcc.tb_pais_id idpais
        ,dcc.tb_departamento_id iddepartamento
        ,dcc.tb_distrito_id iddistrito
        ,dcc.tb_tipodireccion_id idtipodireccion
        FROM tb_companiacontacto cc
        INNER JOIN tb_direccioncompaniacontacto dcc ON cc.id = dcc.tb_companiacontacto_id
        INNER JOIN tb_personacontacto pc ON cc.id = pc.tb_companiacontacto_id 
        WHERE pc.nombre = '$id'";
    
    $result = mysql_query($query, $link_identifier);
    
    if ( !$result )
        throw new Exception("Error en la consulta");
    
    $datos = array();
    $i = 0;
    while ($res = mysql_fetch_assoc($result)) { 
        $datos[$i]['direccion_id'] = $res['direccion_id']; 
        $datos[$i]['direccion'] = $res['direccion']; 
        $datos[$i]['idpais'] = $res['idpais'];
        $datos[$i]['iddepartamento'] = $res['iddepartamento'];
        $datos[$i]['iddistrito'] = $res['iddistrito'];
        $datos[$i]['idtipodireccion'] = $res['idtipodireccion'];
        $i++;
    }
    echo json_encode($datos);
} catch ( Exception $ex ) {
    $ex->getMessage();
}