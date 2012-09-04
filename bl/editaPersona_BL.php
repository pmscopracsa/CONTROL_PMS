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
   } elseif ($_REQUEST['parameter'] == "tm_elimina") {
       $edita_persona->setAActualizar($_REQUEST['parameter']);
       $edita_persona->setIdvalue($_REQUEST['idvalue']);
       $edita_persona->actualizarPersona($cn);
   } elseif ($_REQUEST['parameter'] == "tm_nuevo") {
       $edita_persona->setAActualizar($_REQUEST['parameter']);
       $edita_persona->setValue($_REQUEST['val_nuevotf']);
       $edita_persona->actualizarPersona($cn);
   } elseif ($_REQUEST['parameter'] == "tn_actualiza") { // TELEFONOS NEXTEL
       $edita_persona->setAActualizar($_REQUEST['parameter']);
       $edita_persona->setValue($_REQUEST['value']);
       $edita_persona->setIdvalue($_REQUEST['idvalue']);
       $edita_persona->actualizarPersona($cn);
   } elseif ($_REQUEST['parameter'] == "tn_elimina") {
       $edita_persona->setAActualizar($_REQUEST['parameter']);
       $edita_persona->setIdvalue($_REQUEST['idvalue']);
       $edita_persona->actualizarPersona($cn);
   } elseif ($_REQUEST['parameter'] == "tn_nuevo") {
       $edita_persona->setAActualizar($_REQUEST['parameter']);
       $edita_persona->setValue($_REQUEST['val_nuevotn']);
       $edita_persona->actualizarPersona($cn);
   } elseif ($_REQUEST['parameter'] == 'actualizadireccion') { // DIRECCION
        $edita_persona->setAActualizar($_REQUEST['parameter']);
        $edita_persona->setValue($_REQUEST['txtdireccion']);
        $edita_persona->setIdpais($_REQUEST['idpais']);
        $edita_persona->setIddepartamento($_REQUEST['iddepartamento']);
        $edita_persona->setIddistrito($_REQUEST['iddistrito']);
        $edita_persona->actualizarPersona($cn);
   } elseif ($_REQUEST['parameter'] == 'eliminadireccion') {
        $edita_persona->setAActualizar($_REQUEST['parameter']);
        $edita_persona->actualizarPersona($cn);
    } elseif ($_REQUEST['parameter'] == 'editaEspecialidad') { // ESPECIALIDAD
        $edita_persona->setAActualizar($_REQUEST['parameter']);
        $edita_persona->setIdvalue($_REQUEST['idespecialidad']);
        $edita_persona->actualizarPersona($cn);
    } elseif ($_REQUEST['parameter'] == 'eliminarEspecialidad') {
        $edita_persona->setAActualizar($_REQUEST['parameter']);
        $edita_persona->setIdvalue($_REQUEST['idespecialidad']);
        $edita_persona->actualizarPersona($cn);
    } elseif ($_REQUEST['parameter'] == 'nuevaEspecialidad') {
        $edita_persona->setAActualizar($_REQUEST['parameter']);
        $edita_persona->setIdvalue($_REQUEST['idespecialidad']);
        $edita_persona->actualizarPersona($cn);
    } elseif ($_REQUEST['parameter'] == 'editaObservacion') {
        $edita_persona->setAActualizar($_REQUEST['parameter']);
        $edita_persona->setValue($_REQUEST['observacion']);
        $edita_persona->actualizarPersona($cn);
    } elseif ($_REQUEST['parameter'] == 'editEmail') {
        $edita_persona->setAActualizar($_REQUEST['parameter']);
        $edita_persona->setValue($_REQUEST['email']);
        $edita_persona->actualizarPersona($cn);
    } elseif ($_REQUEST['parameter'] == 'editEmailSecundario') { // EMAIL SECUNDARIOS
        $edita_persona->setAActualizar($_REQUEST['parameter']);
        $edita_persona->setValue($_REQUEST['email']);
        $edita_persona->setIdvalue($_REQUEST['idemail']);
        $edita_persona->actualizarPersona($cn);
    } elseif ($_REQUEST['parameter'] == 'eliminaEmailSecundario') {
        $edita_persona->setAActualizar($_REQUEST['parameter']);
        $edita_persona->setValue($_REQUEST['idemail']);
        $edita_persona->actualizarPersona($cn);
    } elseif ($_REQUEST['parameter'] == 'guardarEmailSecundario') {
        $edita_persona->setAActualizar($_REQUEST['parameter']);
        $edita_persona->setValue($_REQUEST['newmail']);
        $edita_persona->actualizarPersona($cn);
    } elseif ($_REQUEST['parameter'] == 'editarWeb') { // WEB
        $edita_persona->setAActualizar($_REQUEST['parameter']);
        $edita_persona->setValue($_REQUEST['newweb']);
        $edita_persona->actualizarPersona($cn);
    } elseif ($_REQUEST['parameter'] == 'editarFax') { // FAX
        $edita_persona->setAActualizar($_REQUEST['parameter']);
        $edita_persona->setValue($_REQUEST['newfax']);
        $edita_persona->actualizarPersona($cn);
    } elseif ($_REQUEST['parameter'] == 'editarViaEnvio') { // VIA ENVIO
        $edita_persona->setAActualizar($_REQUEST['parameter']);
        $edita_persona->setValue($_REQUEST['new_viaenvio']);
        $edita_persona->actualizarPersona($cn);
    }
} catch (Exception $ex) {
    echo 'Error: '.$ex->getMessage();
}
