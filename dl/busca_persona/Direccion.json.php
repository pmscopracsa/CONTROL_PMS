<?php
require_once '../Conexion.php';

$ruc = $_REQUEST['ruc'];
try {
    $conexion = new Conexion();
    $link_identifier = $conexion->conectar();
    
    if ( !$link_identifier )
        throw new Exception("Problemas al conectar");
    
    $query = "SELECT 
        dcc.direccion direccion
        ,p.nombre pais
        ,d.nombre departamento
        ,dis.nombre distrito
        ,td.descripcion tipodireccion
        FROM tb_companiacontacto cc
        INNER JOIN tb_direccioncompaniacontacto dcc ON cc.id = dcc.tb_companiacontacto_id
        INNER JOIN tb_pais p ON dcc.tb_pais_id = p.id
        INNER JOIN tb_departamento d ON dcc.tb_departamento_id = d.id
        INNER JOIN tb_distrito dis ON dcc.tb_distrito_id = dis.id
        INNER JOIN tb_tipodireccion td ON dcc.tb_tipodireccion_id = td.id
        WHERE cc.ruc = '$ruc'";
    
    $result = mysql_query($query, $link_identifier);
    
    if ( !$result )
        throw new Exception("Error en la consulta");
    
    $datos = array();
    $i = 0;
    while ($res = mysql_fetch_assoc($rs)) {
        $datos[$i]['direccion'] = $res['direccion']; 
        $datos[$i]['pais'] = $res['pais'];
        $datos[$i]['departamento'] = $res['departamento'];
        $datos[$i]['distrito'] = $res['distrito'];
        $datos[$i]['tipodireccion'] = $res['tipodireccion'];
        $i++;
    }
    
} catch ( Exception $ex ) {
    $ex->getMessage();
}