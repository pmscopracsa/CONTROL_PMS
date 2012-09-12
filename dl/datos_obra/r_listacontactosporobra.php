<?php
// Contactos por obra en la table tb_contacto
require_once '../Conexion.php';
$id_obra = $_REQUEST['id_obra'];
$query = "SELECT
            pc.id
            ,pc.nombre nombre
            ,cc.descripcion descripcion
            ,pc.cargo cargo
            ,pc.email email
            ,cc.ruc ruc
            ,pc.fax fax
            FROM tb_contacto c
            INNER JOIN tb_personacontacto pc ON c.tb_personacontacto_id = pc.id
            INNER JOIN tb_companiacontacto cc ON pc.tb_companiacontacto_id = cc.id
            WHERE c.tb_obra_id = $id_obra";

try {
    $cnx = new Conexion();
    $cn = $cnx->conectar();
    if (!$cn)        throw new Exception("Error al conectar: ".  mysql_error());
    mysql_query('SET CHARACTER SET utf8');
    $rs = mysql_query($query);
    if (!$rs)        throw new Exception("Error al consultar: ".  mysql_error());
    
    $contactos = array();
    $i = 0;
    while ($res = mysql_fetch_assoc($rs)) {
        $contactos[$i]['nombre'] = $res['nombre'];
        $contactos[$i]['descripcion'] = $res['descripcion'];
        $contactos[$i]['cargo'] = ($res['cargo'] === NULL) ? "<i>No tiene</i>" : $res['cargo'];
        $contactos[$i]['email'] = ($res['email'] === NULL) ? "<i>No tiene</i>" : $res['email'];
        $contactos[$i]['ruc'] = ($res['ruc'] === NULL) ? "<i>No tiene</i>" : $res['ruc'];
        $contactos[$i]['fax'] = ($res['fax'] === NULL) ? "<i>No tiene</i>" : $res['fax'];
        $contactos[$i]['id'] = $res['id'];
        $i++;
    }
    
    echo json_encode($contactos);
} catch(Exception $ex) {
    echo 'Error: '.$ex->getMessage();
}