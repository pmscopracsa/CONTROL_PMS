<?php
require_once '../dl/Conexion';
require_once '../dl/EditaPersona_DL';

try {
    $cnx = new Conexion();
    $cn = $cnx->conectar();
    if (!$cn)
        throw new Exception("Error al conectar: ".  mysql_error());
    
   $edita_persona = new EditaPersona_DL();
   $edita_persona->setPk($_REQUEST['idpersonacontacto']);
   
   if ($_REQUEST['parameter'] == "editaNumDoc") {
       $edita_persona->setAActualizar($_REQUEST['parameter']);
       $edita_persona->setValue($_REQUEST['value']);
   }
} catch (Exception $ex) {
    echo 'Error: '.$ex->getMessage();
}
