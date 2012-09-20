<?php
require_once '../Conexion.php';
$dni = $_REQUEST['documento'];
$query = "SELECT
    pc.id
    ,dcc.direccion
    ,dcc.id id_direccion
    FROM 
    tb_direccionpersonalaboral dpl
    INNER JOIN tb_personacontacto pc ON dpl.tb_personacontacto_id = pc.id
    INNER JOIN tb_direccioncompaniacontacto dcc ON dpl.tb_direccioncompaniacontacto_id = dcc.id
    WHERE pc.dni = '$dni'";

try {
    $cnx = new Conexion();
    $cn = $cnx->conectar();
    if (!$cn)        throw new Exception("Error al conectar: ".  mysql_error());
    $rs = mysql_query($query);
    if (!$rs)        throw new Exception("Error al consultar: ".  mysql_error());
    
    $contactos = array();
    $i = 0;
    while ($res = mysql_fetch_assoc($rs)) {
        $contactos[$i]['id'] = $res['id'];
        $contactos[$i]['direccion'] = $res['direccion'];
        $contactos[$i]['id_direccion'] = $res['id_direccion'];
        $i++;
    }
    echo json_encode($contactos);
} catch(Exception $ex) {
    echo 'Error: '.$ex->getMessage();
}