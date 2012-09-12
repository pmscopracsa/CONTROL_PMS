<?php
// Listar los contactos y su puesto en la obra
require_once '../Conexion.php';
$id_obra = $_REQUEST['id_obra'];
$query = "SELECT 
            f.posicion
            ,pc.nombre
            ,cc.descripcion
            ,pc.id
            FROM tb_firma f
            INNER JOIN tb_personacontacto pc ON f.idcontacto = pc.id
            INNER JOIN tb_companiacontacto cc ON pc.tb_companiacontacto_id = cc.id
            WHERE f.idobra = $id_obra";

try {
    $cnx = new Conexion();
    $cn = $cnx->conectar();
    if (!$cn)        throw new Exception("Error al conectar: ".  mysql_error());
    $rs = mysql_query($query);
    if (!$rs)        throw new Exception("Error al consultar:" .  mysql_error());
    
    $contactos = array();
    $i = 0;
    while ($res = mysql_fetch_assoc($rs)) {
        $contactos[$i]['posicion'] = $res['posicion'];
        $contactos[$i]['nombre'] = $res['nombre'];
        $contactos[$i]['descripcion'] = $res['descripcion'];
        $contactos[$i]['id'] = $res['id'];
        $i++;
    }
    echo json_encode($contactos);
} catch(Exception $ex) {
    echo 'Error: '.$ex->getMessage();
}