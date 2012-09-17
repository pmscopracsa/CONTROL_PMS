<?php
include_once 'Conexion.php';
$id_reporte = $_REQUEST['idreporte'];
$id_obra = $_REQUEST['id_obra'];
try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    
    if ( !$cn )
        throw new Exception("Error al conectar: ".  mysql_error());
    
    $sql = "SELECT
        pc.id id_contacto
        ,f.posicion posicion
        ,pc.nombre nombre_contacto
        ,cc.descripcion nombre_compania
        ,r.posicion_reporte ubicacion
        FROM tb_contactoreporte r
        INNER JOIN tb_firma f ON r.tb_personacontacto_id = f.idcontacto
        INNER JOIN tb_personacontacto pc ON r.tb_personacontacto_id = pc.id
        INNER JOIN tb_companiacontacto cc ON pc.tb_companiacontacto_id = cc.id
        WHERE tb_reporte_id = $id_reporte AND r.tb_obra_id = $id_obra";
    
    $rs = mysql_query($sql);
    if (!$rs)
        throw new Exception("Error en la consulta: ". mysql_error());
    
    $firmantes_reportes = array();
    $i = 0;
    while ($res = mysql_fetch_assoc($rs)) {
        $firmantes_reportes[$i]['id_contacto'] = $res['id_contacto'];
        $firmantes_reportes[$i]['posicion'] = $res['posicion'];
        $firmantes_reportes[$i]['nombre_contacto'] = $res['nombre_contacto'];
        $firmantes_reportes[$i]['nombre_compania'] = $res['nombre_compania'];
        $firmantes_reportes[$i]['ubicacion'] = $res['ubicacion'];
        $i++;
    }
    echo json_encode($firmantes_reportes);
} catch( Exception $ex ) {
    echo "Mensaje de error: " . $ex->getMessage();
}