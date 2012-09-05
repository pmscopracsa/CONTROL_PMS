<?php
require_once '../dl/Conexion.php';
require_once '../dl/contacto_bl/EditaListaDistribucion_DL.php';

try {
    $cnx = new Conexion();
    $cn = $cnx->conectar();
    if (!$cn)        throw new Exception("Error al conectar: ".  mysql_error());
    
    $edita_lista = new EditaListaDistribucion_DL();
    if ($_REQUEST['parameter'] == 'getidlista') {
        $edita_lista->setAActualizar($_REQUEST['parameter']);
        $edita_lista->setValue($_REQUEST['nombre_lista']);
        $edita_lista->actualizarLista($cn);
    }
    
} catch(Exception $ex) {
    echo 'Error: '.$ex->getMessage();
}
