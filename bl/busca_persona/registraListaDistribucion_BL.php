<?php
include_once '../../dl/busca_persona/RegistraListaDistribucion.php';
include_once '../../dl/funciones/LimpiarVariable.php';

$registraListaDistribucion = new RegistraListaDistribucion();
$limpia = new LimpiarVariable();

/**
 *REGISTRA FORMUALRIO PRINCIPAL
 */
$registraListaDistribucion->set_nombrelista($_REQUEST['nombre'] == "" ? "NULL" : $limpia->Filtro($_REQUEST['nombre']));
$registraListaDistribucion->set_codigoobra($_REQUEST['codigo'] == "" ? "NULL" : $limpia->Filtro($_REQUEST['codigo']));
$registraListaDistribucion->set_observacion($_REQUEST['observacion'] == "" ? "NULL" : $limpia->Filtro($_REQUEST['observacion']));

/**
 * ingresar contactos  
 */
if ($_REQUEST['contador_contactos'] > 0) {
    $contacto_ = array();
    for ($i = 1; $i <= $_REQUEST['contador_contactos']; $i++) 
        array_push($contacto_, $_REQUEST['contacto'.$i]);
    $registraListaDistribucion->set_tbcontactoid($contacto_); //array
}

$registraListaDistribucion->i_RegistraListaDistribucion();
//$registraListaDistribucion->prueba();