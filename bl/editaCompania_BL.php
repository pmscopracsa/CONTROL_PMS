<?php
require_once '../dl/Conexion.php';
require_once '../dl/EditaCompania_DL.php';

try{
    $cnx = new Conexion();
    $cn = $cnx->conectar();
    if (!$cn)
        throw new Exception("Error al conectar: ".  mysql_error());
    
    $edita_compania = new EditaCompania();
    /** SETEO DE VALORES GENERALES */
    $edita_compania->setIdEmpresa($_REQUEST['idEmpresa']);
    $edita_compania->setIdCompania($_REQUEST['idCompania']);
    
    if ($_REQUEST['parameter'] == "tipocompania") {
        $edita_compania->setAActualizar($_REQUEST['parameter']);
        $edita_compania->setValue($_REQUEST['idTipoCompania']);
        $edita_compania->actualizarObjetoCompania($cn);
    } elseif ($_REQUEST['parameter'] == "viaenvio") {
        $edita_compania->setAActualizar($_REQUEST['parameter']);
        $edita_compania->actualizarObjetoCompania($cn);
    } elseif ($_REQUEST['parameter'] == "ruc") {
        $edita_compania->setAActualizar($_REQUEST['parameter']);
        $edita_compania->setValue($_REQUEST['ruc']);
        $edita_compania->actualizarObjetoCompania($cn);
    } elseif ($_REQUEST['parameter'] == "nombre") {
        $edita_compania->setAActualizar($_REQUEST['parameter']);
        $edita_compania->setValue($_REQUEST['nombre']);
        $edita_compania->actualizarObjetoCompania($cn);
    } elseif ($_REQUEST['parameter'] == "nombrecomercial") {
        $edita_compania->setAActualizar($_REQUEST['parameter']);
        $edita_compania->setValue($_REQUEST['nombrecomercial']);
        $edita_compania->actualizarObjetoCompania($cn);
    } elseif ($_REQUEST['parameter'] == "partidaregistral") {
        $edita_compania->setAActualizar($_REQUEST['parameter']);
        $edita_compania->setValue($_REQUEST['partidaregistral']);
        $edita_compania->actualizarObjetoCompania($cn);
    } elseif ($_REQUEST['parameter'] == "giro_actualiza") {
        $edita_compania->setAActualizar($_REQUEST['parameter']);
        $edita_compania->setValue($_REQUEST['val_giro']);
        $edita_compania->setId($_REQUEST['id_giro']);
        $edita_compania->actualizarObjetoCompania($cn);
    } elseif ($_REQUEST['parameter'] == "giro_elimina") {
        $edita_compania->setAActualizar($_REQUEST['parameter']);
        $edita_compania->setId($_REQUEST['id_giro']);
        $edita_compania->actualizarObjetoCompania($cn);
    }
}catch(Exception $ex) {
    echo 'Error: '.$ex->getMessage();
}