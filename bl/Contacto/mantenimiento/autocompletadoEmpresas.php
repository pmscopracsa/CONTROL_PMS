<?php
require_once '../../../dl/Conexion.php';

try {
    
    $script = $_SERVER['PHP_SELF'];
    $path_info = pathinfo($script);
    
    $q = strtolower($_GET['q']);
    if (!$q) return;
    
    $cone = new Conexion();
    $cn = $cone->conectar();
    
    if (!$cn)
        throw new Exception("Error en la conexion. Archivo: ".$path_info['basename']." Error DB: ".  mysql_error(). "\n");
    
    $sql = "SELECT DISTINCT id,descripcion FROM tb_companiacontacto WHERE descripcion LIKE '%$q%'";
    $rs = mysql_query($sql);
    
    if (!$rs)
        throw new Exception("Error en la consulta. Archivo: ".$path_info['basename']." Error DB: ".  mysql_error(). "\n");
    
    while ($registro = mysql_fetch_array($rs)) {
        $empresas = $registro['descripcion'];
        echo $empresas."\n";
    }
} catch ( Exception $ex ) {
    echo "Mensaje de error :\n".$ex->getMessage()."\n";
}