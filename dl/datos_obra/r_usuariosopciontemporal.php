<?php
include_once 'Conexion.php';
$id_opcion = $_REQUEST['id_opcion'];
$id_aleatorio = $_REQUEST['id_aleatorio'];

try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    
    if ( !$cn )
        throw new Exception("Error al conectar: ".  mysql_error());
    
    $sql = "SELECT 
            u.id id
            ,u.nombre nombre
            ,u.nombreusuario nombreusuario
            FROM tb_usuariosopciontemporal uot
            INNER JOIN tb_usuario u
            ON uot.id_usuario = u.id
            WHERE uot.id_opcion = $id_opcion AND uot.aleatorio = $id_aleatorio";
    
    $rs = mysql_query($sql);
    if (!$rs)
        throw new Exception("Error en la consulta (r_usuariosopciontemporal.php): ". mysql_error());
    
    $usuarios_opciones = array();
    $i = 0;
    while ($res = mysql_fetch_assoc($rs)) {
        $usuarios_opciones[$i]['id'] = $res['id'];
        $usuarios_opciones[$i]['nombre'] = $res['nombre'];
        $usuarios_opciones[$i]['nombreusuario'] = $res['nombreusuario'];
        $i++;
    }
    echo json_encode($usuarios_opciones);
} catch( Exception $ex ) {
    echo "Mensaje de error: " . $ex->getMessage();
}