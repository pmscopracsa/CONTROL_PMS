<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
require_once '../../../dl/Conexion.php';

try {
    $q = strtolower($_GET['q']);
    if (!$q) return;
    
    $cone = new Conexion();
    $cn = $cone->conectar();
    
    if (!$cn)
        throw new Exception("Error en la conexion. Error DB: ".  mysql_error(). "\n");
    
    $sql = "SELECT DISTINCT id,tb_empresa_id,descripcion,observacion FROM tb_listadistribucioncontacto WHERE descripcion LIKE '%$q%'";
    $rs = mysql_query($sql);
    
    /**
     * SI EXISTEN DATOS PREVIOS EN LA VARIABLE DE SESION ARRAY LIMPIAR PARA CARGAR LOS NUEVOS 
     */
    if (isset($_SESSION['datos_empresa'])) {   
        unset($_SESSION['datos_empresa']);
    }
    
    if (!$rs)
        throw new Exception("Error en la consulta. Error DB: ".  mysql_error(). "\n");
    
    while ($registro = mysql_fetch_array($rs)) {
        $empresas = $registro['descripcion'];
        echo $empresas."\n";
    }
} catch ( Exception $ex ) {
    echo "Mensaje de error :\n".$ex->getMessage()."\n";
}