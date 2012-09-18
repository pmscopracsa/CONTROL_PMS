<?php
require '../Conexion.php';
$ruc = $_REQUEST['ruc_'];
$query = "SELECT
            pc.nombre nombre
            ,rep.tb_personacontacto_id personaId
            ,rep.inthecontract contract
            FROM tb_representante rep
            INNER JOIN tb_companiacontacto cc ON rep.tb_companiacontacto_id = cc.id
            INNER JOIN tb_personacontacto pc ON rep.tb_personacontacto_id = pc.id
            WHERE cc.ruc = $ruc";

try {
    $cnx = new Conexion();
    $cn = $cnx->conectar();
    if (!$cn)        throw new Exception("Error al conectar: ".  mysql_error());
    
    $rs = mysql_query($query);
    if (!$rs)        throw new Exception("Error al consultar: ".  mysql_error());
    
    $contactos = array();
    $i = 0;
    while ($res = mysql_fetch_assoc($rs)) {
        $contactos[$i]['nombre'] = $res['nombre'];
        $contactos[$i]['personaId'] = $res['personaId'];
        $contactos[$i]['contract'] = $res['contract'];
        $i++;
    }
    
    echo json_encode($contactos);
} catch(Exception $ex) {
    echo 'Error: '.$ex->getMessage();
}