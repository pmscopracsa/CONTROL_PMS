<?php
require_once '../Conexion.php';

$value = $_REQUEST['value'];

try {
    $conexion = new Conexion();
    $link_identifier = $conexion->conectar();
    
    if ( !$link_identifier )
        throw new Exception("Problemas al conectar");
    
    if ($_REQUEST['parameter'] == 'ruc') {
        $query = "SELECT 
        dcc.id iddcc    
        ,dcc.direccion direccion
        ,p.nombre pais
        ,p.id idpais
        ,d.nombre departamento
        ,dis.nombre distrito
        ,td.descripcion tipodireccion
        FROM tb_companiacontacto cc
        INNER JOIN tb_direccioncompaniacontacto dcc ON cc.id = dcc.tb_companiacontacto_id
        INNER JOIN tb_pais p ON dcc.tb_pais_id = p.id
        INNER JOIN tb_departamento d ON dcc.tb_departamento_id = d.id
        INNER JOIN tb_distrito dis ON dcc.tb_distrito_id = dis.id
        INNER JOIN tb_tipodireccion td ON dcc.tb_tipodireccion_id = td.id
        WHERE cc.ruc = '$value'";
    } elseif ($_REQUEST['parameter'] == 'nombre') {
        $query = "SELECT 
        dcc.id iddcc    
        ,dcc.direccion direccion
        ,p.nombre pais
        ,p.id idpais
        ,d.nombre departamento
        ,d.id iddepartamento
        ,dis.nombre distrito
        ,dis.id iddistrito
        ,td.descripcion tipodireccion
        ,td.id idtipodireccion
        FROM tb_companiacontacto cc
        INNER JOIN tb_direccioncompaniacontacto dcc ON cc.id = dcc.tb_companiacontacto_id
        INNER JOIN tb_pais p ON dcc.tb_pais_id = p.id
        INNER JOIN tb_departamento d ON dcc.tb_departamento_id = d.id
        INNER JOIN tb_distrito dis ON dcc.tb_distrito_id = dis.id
        INNER JOIN tb_tipodireccion td ON dcc.tb_tipodireccion_id = td.id
        WHERE cc.descripcion = '$value'";
    }

    
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