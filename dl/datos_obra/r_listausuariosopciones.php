<?php
require_once 'Conexion.php';
$id_opcion = $_REQUEST['opcion'];
$id_aleatorio = $_REQUEST['aleatorio'];

try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    
    if (!$cn)
        throw new Exception("Error al conectar: ".  mysql_error());
    $sql = "SELECT u.id id,u.nombre nombre, u.nombreusuario nombreusuario
            FROM tb_usuariosaprobaciontemporal uat
            INNER JOIN tb_usuario AS u
            ON uat.tb_usuario_id = u.id
            WHERE tb_opcion_id = $id_opcion AND aleatorio = $id_aleatorio";
    $rs = mysql_query($sql);
    
    if (!$rs)
        throw new Exception("Error al consultar: ".  mysql_error());
    
    $usuariosopciones = array();
    $i = 0;
    while ($res = mysql_fetch_assoc($rs)) {
        $usuariosopciones[$i]['id_usuario'] = $res['id'];
        $usuariosopciones[$i]['nombre'] = $res['nombre'];
        $usuariosopciones[$i]['nombreusuario'] = $res['nombreusuario'];
        $i++;
    }
    echo json_encode($usuariosopciones);
} catch (Exception $ex) {
    echo "Error: ".$ex->getMessage();
}