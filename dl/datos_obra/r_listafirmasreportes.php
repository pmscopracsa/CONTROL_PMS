<?php
include_once 'Conexion.php';
$id_reporte = $_REQUEST[''];
$id_aleatorio = $_REQUEST[''];
$id_contacto = $_REQUEST[''];

try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    
    if ( !$cn )
        throw new Exception("Error al conectar: ".  mysql_error());
    
    $sql = "SELECT pc.nombre nombre_contacto, cc.descripcion nombre_compania, r.descripcion nombre_reporte
    FROM tb_contactoreportetemporal crt
    INNER JOIN tb_personacontacto pc
    ON crt.id_contacto = pc.id
    INNER JOIN tb_companiacontacto cc
    ON pc.tb_companiacontacto_id = cc.id
    INNER JOIN tb_reportes r
    ON crt.id_reporte = r.id
    WHERE crt.id_reporte = $id_reporte AND crt.id_aleatorio = $id_aleatorio AND pc.id = $id_contacto";
    
    $rs = mysql_query($sql);
    if (!$rs)
        throw new Exception("Error en la consulta: ". mysql_error());
    
    $firmantes_reportes = array();
    $i = 0;
    while ($res = mysql_fetch_assoc($rs)) {
        $firmantes_reportes[$i]['nombre_contacto'] = $res['nombre_contacto'];
        $firmantes_reportes[$i]['nombre_compania'] = $res['nombre_compania'];
        $firmantes_reportes[$i]['nombre_reporte'] = $res['nombre_reporte'];
    }
    echo json_encode($firmantes_reportes);
    
} catch( Exception $ex ) {
    echo "Mensaje de error: " . $ex->getMessage();
}