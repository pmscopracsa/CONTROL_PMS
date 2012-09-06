<?php
/**
 * tabla: tb_personacontacto
 * modulo: Busca Persona 
 * formulario: Registro de compania
 * div: divSeleccionaRepresentante
 */

include_once '../../dl/Conexion.php';
$conexion = new Conexion();
$link_identifier = $conexion->conectar();

$id = $_REQUEST['id'];

/**
 * CONSULTA PARA OBTENER LOS DATOS DE LA TABLA tb_persona contacto 
 */
//$query = "SELECT * FROM tb_personacontacto WHERE id = $id";
$query = "SELECT
        pc.id
        ,pc.dni
        ,pc.nombre
        ,pc.cargo
        ,pc.fax
        ,pc.email
        ,cc.descripcion
        FROM 
        tb_personacontacto pc INNER JOIN tb_companiacontacto cc ON pc.tb_companiacontacto_id = cc.id WHERE pc.id = $id";
$result = mysql_query($query,$link_identifier);
$representante = array();
$i = 0;

/**
 * CONSULTA PARA OBTENER LOS TELEFONOS FIJOS, MOBILES Y NEXTEL DEL CONTACTO EN CUESTION 
 */
$query_fijo = "SELECT numero FROM tb_telefonofijopersona WHERE tb_personacontacto_id = $id";
$query_mobile = "SELECT numero FROM tb_telefonomovilpersona WHERE tb_personacontacto_id = $id";
$query_nextel = "SELECT numero FROM tb_telefononextelpersona WHERE tb_personacontacto_id = $id";

/**
 *CONSULTA PARA OBTENER LA CANTIDAD DE TELEFONOS FIJOS, MOBILES Y NEXTEL DEL CONTACTO EN CUESTION 
 */
$query_fijo_q = "SELECT numero FROM tb_telefonofijopersona WHERE tb_personacontacto_id = $id";
$res_fijo_q = mysql_query($query_fijo_q,$link_identifier);
$tfijos = array();

/**
 *comprobamos si hay registros 
 */
if (mysql_num_rows($res_fijo_q)) {
    while ($row = mysql_fetch_row($res_fijo_q)) {
        $tfijos[] = $row;
        $tfijos[] = "<br />";
    }
}

$query_mobile_q = "SELECT numero qm FROM tb_telefonomovilpersona WHERE tb_personacontacto_id = $id";
$res_mobile_q = mysql_query($query_mobile_q,$link_identifier);
$tmobiles = array();

if (mysql_numrows($res_mobile_q)) {
    while ($row = mysql_fetch_row($res_mobile_q)) {
        $tmobiles[] = $row;
        $tmobiles[] = "<br />";
    }
}

$query_nextel_q = "SELECT numero qn FROM tb_telefononextelpersona WHERE tb_personacontacto_id = $id";
$res_nextel_q = mysql_query($query_nextel_q, $link_identifier);
$tnextel = array();

if (mysql_numrows($res_nextel_q)) {
    while ($row = mysql_fetch_row($res_nextel_q)) {
        $tnextel[] = $row;
        $tnextel[] = "<br />";
    }
}


while($res = mysql_fetch_assoc($result)) {
    $representante[$i]['id'] = $res['id'];
    $representante[$i]['dni'] = $res['dni'] == NULL ? "<i id=\"sindatos\">No tiene</i>" : $res['dni'];
    $representante[$i]['nombre'] = $res['nombre'] === NULL ? "<i id=\"sindatos\">No tiene</i>" : $res['nombre'];
    $representante[$i]['cargo'] = $res['cargo'] === NULL ? "<i id=\"sindatos\">No tiene</i>" : $res['cargo'];
    $representante[$i]['fax'] = $res['fax'] === NULL ? "<i id=\"sindatos\">No tiene</i>" : $res['fax'];
    $representante[$i]['email'] = $res['email'] === NULL ? "<i id=\"sindatos\">No tiene</i>" : $res['email'];
    $representante[$i]['qnt_tf'] = mysql_num_rows($res_fijo_q) == 0 
        ? "<i id=\"sindatos\">No tiene</i>" 
        : $tfijos;
    $representante[$i]['qnt_tm'] = mysql_num_rows($res_mobile_q) == 0 
        ? "<i id=\"sindatos\">No tiene</i>" 
        : $tmobiles;
    $representante[$i]['qnt_tn'] = mysql_num_rows($res_nextel_q) == 0 
        ? "<i id=\"sindatos\">No tiene</i>" 
        : $tnextel;
    $representante[$i]['descripcion'] = $res['descripcion'];
    $i++;
}
echo json_encode($representante);

foreach ($tfijos as $value) {
    echo $value."<br />";
}
?>
