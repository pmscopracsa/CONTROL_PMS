<?php
require_once '../dl/Conexion.php';
require_once '../dl/EditaCompania_DL.php';

try{
    $cnx = new Conexion();
    $cn = $cnx->conectar();
    if (!$cn)
        throw new Exception("Error al conectar: ".  mysql_error());
    
    $edita_compania = new EditaCompania();
    
    if ($_REQUEST['parameter'] == "tipocompania") {
        $edita_compania->setTabla('tb_companiacontacto');
        $edita_compania->setIdEmpresa($_REQUEST['idEmpresa']);
        $edita_compania->setIdCompania($_REQUEST['idCompania']);
        $edita_compania->setValue($_REQUEST['idTipoCompania']);
        $edita_compania->actualizarObjetoCompania($cn);
    } elseif ($_REQUEST['parameter'] == "viaenvio") {
        $edita_compania->setTabla('tb_companiacontacto');
        $edita_compania->setIdEmpresa($_REQUEST['idEmpresa']);
        $edita_compania->setIdCompania($_REQUEST['idCompania']);
        $edita_compania->actualizarObjetoCompania($cn);
    }
}catch(Exception $ex) {
    echo 'Error: '.$ex->getMessage();
}