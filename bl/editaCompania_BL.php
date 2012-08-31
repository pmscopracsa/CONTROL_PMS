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
    } elseif ($_REQUEST['parameter'] == "actividadprincipal") {
        $edita_compania->setAActualizar($_REQUEST['parameter']);
        $edita_compania->setValue($_REQUEST['actividadprincipal']);
        $edita_compania->actualizarObjetoCompania($cn);
    } elseif ($_REQUEST['parameter'] == "tf_actualiza") {
        $edita_compania->setAActualizar($_REQUEST['parameter']);
        $edita_compania->setValue($_REQUEST['val_tf']);
        $edita_compania->setId($_REQUEST['id_tf']);
        $edita_compania->actualizarObjetoCompania($cn);
    } elseif ($_REQUEST['parameter'] == "tf_elimina") {
        $edita_compania->setAActualizar($_REQUEST['parameter']);
        $edita_compania->setId($_REQUEST['id_tf']);
        $edita_compania->actualizarObjetoCompania($cn);
    } elseif ($_REQUEST['parameter'] == "tm_edita") {
        $edita_compania->setAActualizar($_REQUEST['parameter']);
        $edita_compania->setValue($_REQUEST['val_tm']);
        $edita_compania->setId($_REQUEST['id_tm']);
        $edita_compania->actualizarObjetoCompania($cn);
    } elseif ($_REQUEST['parameter'] == "tm_elimina") {
        $edita_compania->setAActualizar($_REQUEST['parameter']);
        $edita_compania->setId($_REQUEST['id_tmobile']);
        $edita_compania->actualizarObjetoCompania($cn);
    } elseif ($_REQUEST['parameter'] == "tn_actualiza") {
        $edita_compania->setAActualizar($_REQUEST['parameter']);
        $edita_compania->setValue($_REQUEST['val_tnextel']);
        $edita_compania->setId($_REQUEST['id_tnextel']);
        $edita_compania->actualizarObjetoCompania($cn);
    } elseif ($_REQUEST['parameter'] == "tn_elimina") {
        $edita_compania->setAActualizar($_REQUEST['parameter']);
        $edita_compania->setId($_REQUEST['id_tnextel']);
        $edita_compania->actualizarObjetoCompania($cn);
    } elseif ($_REQUEST['parameter'] == "fax_actualiza") {
        $edita_compania->setAActualizar($_REQUEST['parameter']);
        $edita_compania->setValue($_REQUEST['fax']);
        $edita_compania->actualizarObjetoCompania($cn);
    } elseif ($_REQUEST['parameter'] == "viaenvio") {
        $edita_compania->setAActualizar($_REQUEST['parameter']);
        $edita_compania->setValue($_REQUEST['viaenvio_id']);
        $edita_compania->actualizarObjetoCompania($cn);
    } elseif ($_REQUEST['parameter'] == "especialidad_actualiza") {
        $edita_compania->setAActualizar($_REQUEST['parameter']);
        $edita_compania->setValue($_REQUEST['id_especialidad_new']);
        $edita_compania->setFk($_REQUEST['id_especialidad_old']);
        $edita_compania->actualizarObjetoCompania($cn);
    } elseif ($_REQUEST['parameter'] == "especialidad_elimina") {
        $edita_compania->setAActualizar($_REQUEST['parameter']);
        $edita_compania->setValue($_REQUEST['id_especialidad_old']);
        $edita_compania->actualizarObjetoCompania($cn);
    } elseif ($_REQUEST['parameter'] == "representante_actualiza") {
        $edita_compania->setAActualizar($_REQUEST['parameter']);
        $edita_compania->setValue($_REQUEST['id_representante_new']);
        $edita_compania->setFk($_REQUEST['id_representante_old']);
        $edita_compania->actualizarObjetoCompania($cn);
    } elseif ($_REQUEST['parameter'] == "giro_nuevo") {
        $edita_compania->setAActualizar($_REQUEST['parameter']);
        $edita_compania->setValue($_REQUEST['val_nuevogiro']);
        $edita_compania->actualizarObjetoCompania($cn);
    }
}catch(Exception $ex) {
    echo 'Error: '.$ex->getMessage();
}