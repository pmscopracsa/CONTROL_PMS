<?php
include_once 'Conexion.php';
$aleatorio = $_REQUEST['aleatorio'];
$reporte = $_REQUEST['reporte'];
try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    if ( !$cn )
        throw new Exception("Error al conectar: ".  mysql_error());
    
    /**
     * ARREGLAR EL QUE AL CONSULTAR NO DEBE MOSTRAR LOS QUE YA ESTAN ASIGNADOS 
     */
    
    $sql = "SELECT fct.id_contacto id_contacto, fct.txt_puesto txt_puesto,pc.nombre nombre_contacto, fct.aleatorio aleatorio, fct.estado_asignado AS estado_asignado
    FROM tb_firmascontactotemporal fct 
    INNER JOIN tb_personacontacto pc
    ON fct.id_contacto = pc.id
    WHERE fct.aleatorio = $aleatorio";
    
    $rs = mysql_query($sql);
    if (!$rs)
        throw new Exception("Error en la consulta");
    
    $a_firmar = array();
    $i = 0;
    while ($res = mysql_fetch_assoc($rs)) {
        $a_firmar[$i]['txt_puesto'] = $res['txt_puesto'];
        $a_firmar[$i]['nombre_contacto'] = $res['nombre_contacto'];
        $a_firmar[$i]['id_contacto'] = $res['id_contacto'];
        $a_firmar[$i]['estado_asignado'] = $res['estado_asignado'] == "n" ? "Aun no asignado" : "Ya esta asignado";
        $i++;
    }
    echo json_encode($a_firmar);
} catch( Exception $ex ) {
    echo "Mensaje de error: " . $ex->getMessage();
}