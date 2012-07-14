<?php
require_once '../../dl/Conexion.php';
$id = $_REQUEST['id'];

try {
    $conexion = new Conexion();
    $ch = $conexion->conectar();
    
    if (!$ch)
        throw new Exception("Error al conectar a la ddbb:".  mysql_error());
    
    $query = "SELECT 
                id
                ,nombre
                ,nombreusuario
                FROM tb_usuario
                WHERE id = $id";
    
    $rs = mysql_query($query);
    
    if (!$rs)
        throw new Exception("Error al consultar: ".  mysql_error());
} catch (Exception $ex) {
    echo "Error: ".$ex->getMessage();
}

$usuario_json = array();
$i = 0;

while ($res = mysql_fetch_assoc($rs)) {
    $usuario_json[$i]['id'] = $res['id'];
    $usuario_json[$i]['nombre'] = $res['nombre'];
    $usuario_json[$i]['nombreusuario'] = $res['nombreusuario'];
    $i++;
}
echo json_encode($usuario_json);