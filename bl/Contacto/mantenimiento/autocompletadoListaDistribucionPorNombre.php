<?php
session_start();
require_once '../../../dl/Conexion.php';

try {
    
    $script = $_SERVER['PHP_SELF'];
    $path_info = pathinfo($script);
    
    $datos_empresa = array();
    
    $q = strtolower($_GET['q']);
    if (!$q) return;
    
    $cone = new Conexion();
    $cn = $cone->conectar();
    
    if (!$cn)
        throw new Exception("Error en la conexion. Archivo: ".$path_info['basename']." Error DB: ".  mysql_error(). "\n");
    
    $sql = "SELECT DISTINCT id,tb_empresa_id,descripcion,observacion FROM tb_listadistribucioncontacto WHERE descripcion LIKE '%$q%'";
    $rs = mysql_query($sql);
    
    
    
    if (isset($_SESSION['datos_empresa'])) unset ($_SESSION['datos_empresa']) ;
    
    if (!$rs)
        throw new Exception("Error en la consulta. Archivo: ".$path_info['basename']." Error DB: ".  mysql_error(). "\n");
    
    while ($registro = mysql_fetch_array($rs)) {
        $empresas = $registro['descripcion'];
        if (!isset($_SESSION['datos_empresa'])) $_SESSION['datos_empresa'] = $datos_empresa($_registro['id'],$_registro['tb_empresa_id'],$_registro['observacion']);
        echo $empresas."\n";
    }
} catch ( Exception $ex ) {
    echo "Mensaje de error :\n".$ex->getMessage()."\n";
}