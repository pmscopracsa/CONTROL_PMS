<?php
include_once '../../dl/Conexion.php';
$id = $_REQUEST['id'];

try {
    $conexion = new Conexion();
    $link_identifier = $conexion->conectar();
    
    if ( !$link_identifier )
        throw new Exception("Problemas al conectar");
    
    $query = "SELECT pc.id id, pc.nombre nombre, cc.descripcion empresa
            FROM tb_personacontacto pc
            INNER JOIN tb_companiacontacto cc
            ON pc.tb_companiacontacto_id = cc.id
            WHERE pc.id = $id
            ORDER BY nombre ASC";
    
    /*
    $query = "SELECT * FROM tb_personacontacto a
        INNER JOIN temporal  b
        ON a.id = b.id_contacto";*/
    $result = mysql_query($query, $link_identifier);
    
    if ( !$result )
        throw new Exception("Error en la consulta");
    
} catch ( Exception $ex ) {
    $ex->getMessage();
}

$contacto_json = array();
$i = 0;

while ($res = mysql_fetch_assoc($result)) {
    $contacto_json[$i]['id'] = $res['id'];
    $contacto_json[$i]['nombre'] = $res['nombre'];
    $contacto_json[$i]['empresa'] = $res['empresa'];
    $i++;
}

echo json_encode($contacto_json);