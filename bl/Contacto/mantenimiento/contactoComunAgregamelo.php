<?php
include_once '../../../dl/busca_persona/ProveedorRecomendado.php';
$proveedor_recomendado = new ProveedorRecomendado();

$proveedor_recomendado->set_id_empresa($_REQUEST['id_empresa']);
$proveedor_recomendado->set_id_persona($_REQUEST['id_persona']);

$proveedor_recomendado->importarContactoComun();