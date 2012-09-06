<?php
include_once '../../dl/busca_persona/RegistraListaDistribucion.php';
include_once '../../dl/funciones/LimpiarVariable.php';

$registraListaDistribucion = new RegistraListaDistribucion();
$limpia = new LimpiarVariable();

/**
 *REGISTRA FORMUALRIO PRINCIPAL
 */
$registraListaDistribucion->set_empresaid($_REQUEST['idEmpresa']);
$registraListaDistribucion->set_nombrelista($limpia->Filtro($_REQUEST['nombre']));
$registraListaDistribucion->setCodigoobra($_REQUEST['idtxtobra']);
$registraListaDistribucion->set_observacion($limpia->Filtro($_REQUEST['observacion']));

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