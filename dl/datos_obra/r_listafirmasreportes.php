<?php
include_once 'Conexion.php';
$id_reporte = $_REQUEST['checked'];
$id_aleatorio = $_REQUEST['aleatorio'];


try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    
    if ( !$cn )
        throw new Exception("Error al conectar: ".  mysql_error());
    
    /*$sql = "SELECT pc.nombre AS nombre_contacto, cc.descripcion AS nombre_compania, r.descripcion AS nombre_reporte
    FROM tb_contactoreportetemporal AS crt
    INNER JOIN tb_personacontacto AS pc
    ON crt.id_contacto = pc.id
    INNER JOIN tb_companiacontacto AS cc
    ON pc.tb_companiacontacto_id = cc.id
    INNER JOIN tb_reportes AS r
    ON crt.id_reporte = r.id
    WHERE crt.id_reporte = $id_reporte AND crt.id_aleatorio = $id_aleatorio AND pc.id = $id_contacto";*/
    
    $sql = "SELECT fct.txt_puesto AS posicion, pc.nombre AS nombre_contacto, cc.descripcion AS nombre_compania
    FROM tb_firmascontactotemporal fct
    INNER JOIN tb_personacontacto AS pc
    ON fct.id_contacto = pc.id
    INNER JOIN tb_companiacontacto AS cc
    ON pc.tb_companiacontacto_id = cc.id
    INNER JOIN tb_contactoreportetemporal AS crt
    ON fct.id_contacto = crt.id_contacto
    WHERE crt.id_reporte = $id_reporte AND crt.id_aleatorio = $id_aleatorio";
    
    $rs = mysql_query($sql);
    if (!$rs)
        throw new Exception("Error en la consulta: ". mysql_error());
    
    $firmantes_reportes = array();
    $i = 0;
    while ($res = mysql_fetch_assoc($rs)) {
        $firmantes_reportes[$i]['posicion'] = $res['posicion'];
        $firmantes_reportes[$i]['nombre_contacto'] = $res['nombre_contacto'];
        $firmantes_reportes[$i]['nombre_compania'] = $res['nombre_compania'];
        $i++;
    }
    echo json_encode($firmantes_reportes);
} catch( Exception $ex ) {
    echo "Mensaje de error: " . $ex->getMessage();
}