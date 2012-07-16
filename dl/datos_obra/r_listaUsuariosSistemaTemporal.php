<?php
include_once 'Conexion.php';
$aleatorio = $_REQUEST['aleatorio'];

try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    if ( !$cn )
        throw new Exception("Error al conectar: ".  mysql_error());
    
    /**
     * ARREGLAR EL QUE AL CONSULTAR NO DEBE MOSTRAR LOS QUE YA ESTAN ASIGNADOS 
     */
    
    $sql = "SELECT u.id id,u.nombre nombre, u.nombreusuario nombreusuario
            FROM tb_usuariosaprobaciontemporal uat
            INNER JOIN tb_usuario AS u
            ON uat.tb_usuario_id = u.id
            WHERE aleatorio = $aleatorio";
    
    $rs = mysql_query($sql);
    if (!$rs)
        throw new Exception("Error en la consulta");
    
    $a_teneropcionestop = array();
    $i = 0;
    while ($res = mysql_fetch_assoc($rs)) {
        $a_teneropcionestop[$i]['id_usuario'] = $res['id'];
        $a_teneropcionestop[$i]['nombre'] = $res['nombre'];
        $a_teneropcionestop[$i]['nombreusuario'] = $res['nombreusuario'];
        $i++;
    }
    echo json_encode($a_teneropcionestop);
} catch( Exception $ex ) {
    echo "Mensaje de error: " . $ex->getMessage();
}