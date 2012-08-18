<?php
require_once '../../../dl/Conexion.php';

try {
    $q = strtolower($_GET['nombre_persona']);
    if (!$q) return;
    
    $cone = new Conexion();
    $cn = $cone->conectar();
    
    if (!$cn)
        throw new Exception("Error en la conexion: ". mysql_error(). "\n");
    
    $sql = "SELECT * FROM tb_personacontacto WHERE nombre = '". $_REQUEST['nombre_persona']."'";
    
    $rs = mysql_query($sql);
    
    if (!$rs)
        throw new Exception("Error en la consulta. Archivo: ". mysql_error(). "\n");
    
    if (mysql_num_rows($rs) > 0)
        echo "tiene";
    else
        echo "no_tiene";
} catch ( Exception $ex ) {
    echo "Mensaje de error :\n".$ex->getMessage()."\n";
}