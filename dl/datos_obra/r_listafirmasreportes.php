<?php
include_once 'Conexion.php';
$id_reporte = $_REQUEST['checked'];
$id_aleatorio = $_REQUEST['aleatorio'];

try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    
    if ( !$cn )
        throw new Exception("Error al conectar: ".  mysql_error());
    
    $sql = "SELECT pc.id AS id_contacto,fct.txt_puesto AS posicion, pc.nombre AS nombre_contacto, cc.descripcion AS nombre_compania, rcpft.posicion AS numero_posi
    FROM tb_firmascontactotemporal fct
    INNER JOIN tb_personacontacto AS pc
    ON fct.id_contacto = pc.id
    INNER JOIN tb_companiacontacto AS cc
    ON pc.tb_companiacontacto_id = cc.id
    INNER JOIN tb_contactoreportetemporal AS crt
    ON fct.id_contacto = crt.id_contacto
    
    INNER JOIN tb_reportecontactoposicionfirmatemporal AS rcpft
    ON fct.id_contacto = rcpft.id_contacto
    
    WHERE crt.id_reporte = $id_reporte AND crt.id_aleatorio = $id_aleatorio";
    
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
        $firmantes_reportes[$i]['numero_posi'] = $res['numero_posi'];
        $i++;
    }
    echo json_encode($firmantes_reportes);
} catch( Exception $ex ) {
    echo "Mensaje de error: " . $ex->getMessage();
}