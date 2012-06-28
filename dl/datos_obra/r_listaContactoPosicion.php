<?php
include_once 'Conexion.php';
$aleatorio = $_REQUEST['aleatorio'];
try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    if ( !$cn )
        throw new Exception("Error al conectar: ".  mysql_error());
    $sql = "SELECT * FROM tb_firmascontactotemporal WHERE aleatorio = ".$aleatorio;
    $rs = mysql_query($sql);
    if (!$rs)
        throw new Exception("Error en la consulta");
    
    $a_firmar = array();
    while ($res = mysql_fetch_assoc($rs)) {
        $a_firmar[$i]['txt_puesto'] = $res['txt_puesto'];
        $i++;
    }
    echo json_encode($a_firmar);
} catch( Exception $ex ) {
    echo "Mensaje de error: " . $ex->getMessage();
}