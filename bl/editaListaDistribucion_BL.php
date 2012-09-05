<?php
require_once '../dl/Conexion.php';
require_once '../dl/contacto_bl/EditaListaDistribucion_DL.php';

try {
    $cnx = new Conexion();
    $cn = $cnx->conectar();
    if (!$cn)        throw new Exception("Error al conectar: ".  mysql_error());
    
    $edita_lista = new EditaListaDistribucion_DL();
    $edita_lista->setPk($_REQUEST['idlistadistribucion']);
    if ($_REQUEST['parameter'] == 'agregacontacto') {
        $edita_lista->setAActualizar($_REQUEST['parameter']);
        $edita_lista->setValue($_REQUEST['idnewcontacto']);
        $edita_lista->actualizarLista($cn);
    } elseif ($_REQUEST['parameter'] == 'eliminacontacto') {
        $edita_lista->setAActualizar($_REQUEST['parameter']);
        $edita_lista->setValue($_REQUEST['idcontactoeliminar']);
        $edita_lista->actualizarLista($cn);
    } elseif ($_REQUEST['parameter'] == 'editarnombrelista') {
        $edita_lista->setAActualizar($_REQUEST['parameter']);
        $edita_lista->setValue($_REQUEST['nombrelista']);
        $edita_lista->actualizarLista($cn);
    } elseif ($_REQUEST['parameter'] == 'editaobs') {
        $edita_lista->setAActualizar($_REQUEST['parameter']);
        $edita_lista->setValue($_REQUEST['observacion']);
        $edita_lista->actualizarLista($cn);
    }
    
} catch(Exception $ex) {
    echo 'Error: '.$ex->getMessage();
}
