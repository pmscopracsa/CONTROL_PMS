<?php
include_once 'Conexion.php';
$aleatorio = $_REQUEST['aleatorio'];

try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    if ( !$cn )
        throw new Exception("Error al conectar: ".  mysql_error());
    
    $sql = "SELECT u.id id, u.nombre nombre, u.nombreusuario nombreusuario
            FROM tb_usuariosaprobaciontemporal uat
            INNER JOIN tb_usuario u
            ON uat.tb_usuario_id = u.id
            WHERE uat.aleatorio = $aleatorio";
    
    $rs = mysql_query($sql);
    if (!$rs)
        throw new Exception("Error en la consulta");
    
    $a_firmar = array();
    $i = 0;
    while ($res = mysql_fetch_assoc($rs)) {
        $a_firmar[$i]['id_usuario'] = $res['id'];
        $a_firmar[$i]['txt_nombre'] = $res['nombre'];
        $a_firmar[$i]['txt_nombreusuario'] = $res['nombreusuario'];
        $i++;
    }
    echo json_encode($a_firmar);
} catch( Exception $ex ) {
    echo "Mensaje de error: " . $ex->getMessage();
}
