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
$query = "SELECT * FROM tb_personacontacto WHERE id = $id";
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

$query_mobile_q = "SELECT numero qm FROM tb_telefonomovilpersona WHERE tb_personacontacto_id = $id";
$res_mobile_q = mysql_query($query_mobile_q,$link_identifier);

$query_nextel_q = "SELECT numero qn FROM tb_telefononextelpersona WHERE tb_personacontacto_id = $id";
$res_nextel_q = mysql_query($query_nextel_q, $link_identifier);

while($res = mysql_fetch_assoc($result)) {
    $representante[$i]['id'] = $res['id'];
    $representante[$i]['dni'] = $res['dni'] == NULL ? "<i>No tiene</i>" : $res['dni'];
    $representante[$i]['nombre'] = $res['nombre'] === NULL ? "<i>No tiene</i>" : $res['nombre'];
    $representante[$i]['cargo'] = $res['cargo'] === NULL ? "<i>No tiene</i>" : $res['cargo'];
    $representante[$i]['fax'] = $res['fax'] === NULL ? "<i>No tiene</i>" : $res['fax'];
    $representante[$i]['email'] = $res['email'] === NULL ? "<i>No tiene</i>" : $res['email'];
    $representante[$i]['qnt_tf'] = mysql_num_rows($res_fijo_q) == 0 
        ? "<i>No tiene</i>" 
        : '<b id="fijo" title="foo">Tiene '.mysql_num_rows($res_fijo_q)." n&uacute;meros</b>";
    $representante[$i]['qnt_tm'] = mysql_num_rows($res_mobile_q) == 0 
        ? "<i>No tiene</i>" 
        : "<b>Tiene ".mysql_num_rows($res_mobile_q)." n&uacute;meros</b>";
    $representante[$i]['qnt_tn'] = mysql_num_rows($res_nextel_q) == 0 
        ? "<i>No tiene</i>" 
        : "<b>Tiene ".mysql_num_rows($res_nextel_q)." n&uacute;meros</b>";
    $i++;
}
echo json_encode($representante);
/**
 * todo: telefonos (fijo - movil) 
 */
?>
