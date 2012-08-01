<?php

session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
$idEmpresa = $_SESSION['id'];

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
    
    //$sql = "SELECT DISTINCT ruc FROM tb_companiacontacto WHERE ruc LIKE '%$q%'";
    $sql = "SELECT DISTINCT cc.ruc
            FROM tb_empresa e
            INNER JOIN tb_companiacontacto cc ON e.id = cc.tb_empresa_id
            WHERE e.id = $idEmpresa AND cc.ruc LIKE '%$q%'";
    
    $rs = mysql_query($sql);
    
    if (!$rs)
        throw new Exception("Error en la consulta. Archivo: ".$path_info['basename']." Error DB: ".  mysql_error(). "\n");
    
    while ($registro = mysql_fetch_array($rs)) {
        $empresas = $registro['ruc'];
        echo $empresas."\n";
    }
} catch ( Exception $ex ) {
    echo "Mensaje de error :\n".$ex->getMessage()."\n";
}