<?php

/**
 * BL: TOMA LOS SIGUIENTES DATOS:
 * especialidad, empresa y contacto (todos estos relacionados)
 * y los pasa a mis contactos.  
 */
include_once '../../../dl/busca_persona/ProveedorRecomendado.php';
$proveedor_recomendado = new ProveedorRecomendado();

$proveedor_recomendado->set_id_empresa($_REQUEST['id_empresa']);
$proveedor_recomendado->set_id_persona($_REQUEST['id_persona']);
$proveedor_recomendado->set_id_especialidad($_REQUEST['id_especialidad']);

$proveedor_recomendado->importarContactoComun();
//$proveedor_recomendado->importaPrueba();