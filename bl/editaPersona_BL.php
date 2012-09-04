<?php
require_once '../dl/Conexion.php';
require_once '../dl/EditaPersona_DL.php';

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
       $edita_persona->actualizarPersona($cn);
   } elseif ($_REQUEST['parameter'] == "editaNombres") {
       $edita_persona->setAActualizar($_REQUEST['parameter']);
       $edita_persona->setValue($_REQUEST['value']);
       $edita_persona->actualizarPersona($cn);
   } elseif ($_REQUEST['parameter'] == "editaCompania") {
       $edita_persona->setAActualizar($_REQUEST['parameter']);
       $edita_persona->setValue($_REQUEST['value']);
       $edita_persona->actualizarPersona($cn);
   } elseif ($_REQUEST['parameter'] == "editaCargo") {
       $edita_persona->setAActualizar($_REQUEST['parameter']);
       $edita_persona->setValue($_REQUEST['value']);
       $edita_persona->actualizarPersona($cn);
   } elseif ($_REQUEST['parameter'] == "tf_actualiza") { // TELEFONOS FIJOS
       $edita_persona->setAActualizar($_REQUEST['parameter']);
       $edita_persona->setValue($_REQUEST['value']);
       $edita_persona->setIdvalue($_REQUEST['idvalue']);
       $edita_persona->actualizarPersona($cn);
   } elseif ($_REQUEST['parameter'] == "tf_elimina") {
       $edita_persona->setAActualizar($_REQUEST['parameter']);
       $edita_persona->setIdvalue($_REQUEST['idvalue']);
       $edita_persona->actualizarPersona($cn);
   } elseif ($_REQUEST['parameter'] == "tf_nuevo") {
       $edita_persona->setAActualizar($_REQUEST['parameter']);
       $edita_persona->setValue($_REQUEST['val_nuevotf']);
       $edita_persona->actualizarPersona($cn);
   }  elseif ($_REQUEST['parameter'] == "tm_actualiza") { // TELEFONOS MOBILE
       $edita_persona->setAActualizar($_REQUEST['parameter']);
       $edita_persona->setValue($_REQUEST['value']);
       $edita_persona->setIdvalue($_REQUEST['idvalue']);
       $edita_persona->actualizarPersona($cn);
   } 
} catch (Exception $ex) {
    echo 'Error: '.$ex->getMessage();
}
