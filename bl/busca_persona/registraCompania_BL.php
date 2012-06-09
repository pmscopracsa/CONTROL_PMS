<?php

/**
 * 
 */
include_once '../../dl/busca_persona/RegistraCompania.php';

$tipocompania = $_REQUEST['tipocompaniaseleccionada'];
$ruc = $_REQUEST['ruc'];
$nombre = $_REQUEST['nombre'];
$nombrecomercial = $_REQUEST['nombrecomercial'];
$partidaregistral = $_REQUEST['partidaregistral'];
/**
 * GIRO M:N 
 */
$actividadprincipal = $_REQUEST['actividadprincipal'];

/**
 * TELEFONOS M:N 
 */

/**
 * DIRECCION M:N 
 */

/**
 * ESPECIALIDAD M:N 
 */

/**
 * REPRESENTANTE M:N 
 */

$observacion = $_REQUEST['observacion'];
$email = $_REQUEST['email'];
$web = $_REQUEST['web'];
$viaenvio = $_REQUEST['viaenvioseleccionada'];
?>
