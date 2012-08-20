<?php
include_once '../../dl/Conexion.php';
$id = $_REQUEST['id'];

try {
    $conexion = new Conexion();
    $link_identifier = $conexion->conectar();
    
    if ( !$link_identifier )
        throw new Exception("Problemas al conectar");
    
    $query = "SELECT 
            pc.id id
            ,pc.nombre nombre
            ,pc.cargo cargo
            ,pc.email email_persona
            ,cc.descripcion empresa 
            ,cc.ruc ruc_empresa
            ,cc.fax fax_empresa
            ,tf.numero tf
            ,tm.numero tm
            ,tn.numero tn
            FROM tb_personacontacto pc
            INNER JOIN tb_comuntfijo tf ON pc.id = tf.tb_personacontactocomun_id
            INNER JOIN tb_comuntmobile tm ON pc.id = tm.tb_personacontactocomun_id
            INNER JOIN tb_comuntnextel tn ON pc.id = tn.tb_personacontactocomun_id
            INNER JOIN tb_companiacontacto cc ON pc.tb_companiacontacto_id = cc.id
            WHERE pc.id = $id
            GROUP BY pc.id";
    
//        $query = "SELECT 
//            pc.id id
//            ,pc.nombre nombre
//            ,pc.cargo cargo
//            ,pc.email email_persona
//            ,cc.descripcion empresa 
//            ,cc.ruc ruc_empresa
//            ,cc.fax fax_empresa
//            ,tf.numero tf
//            ,tm.numero tm
//            ,tn.numero tn
//            FROM tb_personacontacto pc
//            INNER JOIN tb_comuntfijo tf ON pc.id = tf.tb_personacontactocomun_id
//            INNER JOIN tb_comuntmobile tm ON pc.id = tm.tb_personacontactocomun_id
//            INNER JOIN tb_comuntnextel tn ON pc.id = tn.tb_personacontactocomun_id
//            INNER JOIN tb_companiacontacto cc ON pc.tb_companiacontacto_id = cc.id
//            WHERE pc.id = $id
//            GROUP BY pc.id";
    
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
    $contacto_json[$i]['nombre'] = $res['nombre'] == NULL ? "<i id=\"sindatos\">No se ha especificado</i>" : strtoupper($res['nombre']);
    $contacto_json[$i]['empresa'] = $res['empresa'] == NULL ? "<i id=\"sindatos\">No se ha especificado</i>" : strtoupper($res['empresa']);
    $contacto_json[$i]['cargo'] = $res['cargo'] == NULL ? "<i id=\"sindatos\">No se ha especificado</i>" : strtoupper($res['cargo']);
    $contacto_json[$i]['email_persona'] = $res['email_persona']  == NULL ? "<i id=\"sindatos\">No se ha especificado</i>" : strtolower($res['email_persona']);
    $contacto_json[$i]['ruc_empresa'] = $res['ruc_empresa'] == NULL ? "<i id=\"sindatos\">No se ha especificado</i>" : strtoupper($res['ruc_empresa']);
    $contacto_json[$i]['fax_empresa'] = $res['fax_empresa'] == NULL ? "<i id=\"sindatos\">No se ha especificado</i>" : strtoupper($res['fax_empresa']);
//    $contacto_json[$i]['tf'] = $res['tf'] == NULL ? "<i id=\"sindatos\">No se ha especificado</i>" : strtoupper($res['tf']);
//    $contacto_json[$i]['tn'] = $res['tn'] == NULL ? "<i id=\"sindatos\">No se ha especificado</i>" : strtoupper($res['tn']);
//    $contacto_json[$i]['tm'] = $res['tm'] == NULL ? "<i id=\"sindatos\">No se ha especificado</i>" : strtoupper($res['tm']);
    $i++;
}
echo json_encode($contacto_json);