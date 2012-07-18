<?php
include_once '../../dl/datos_obra/RegistraDatosObra.php';
include_once '../../dl/funciones/LimpiarVariable.php';

$registradatosobra = new RegistraDatosObra();
$limpia = new LimpiarVariable();

/**
 *  
 */
$registradatosobra->set_nombre($limpia->Filtro($_REQUEST['']));
$registradatosobra->set_finicio();
$registradatosobra->set_ffin();
$registradatosobra->set_direccionobra($limpia->Filtro($_REQUEST['']));
$registradatosobra->set_tbdepartamentoid();
$registradatosobra->set_tbmonedaid();

$registradatosobra->set_tbclienteid();
$registradatosobra->set_empresacontratante();

$registradatosobra->set_empresagerenteproyecto();
$registradatosobra->set_empresasupervisoraproyecto();

/**
 * PARAMETROS PRESUPUESTO DE VENTAS
 */
$registradatosobra->set_tbtipovalorizacionid();
$registradatosobra->set_tbformatopresupuesto();
$registradatosobra->set_factorcoreccion($limpia->Filtro($_REQUEST['']));
$registradatosobra->set_retencionfondogarantia($limpia->Filtro($_REQUEST['']));
$registradatosobra->set_retencionfielcumplimiento($limpia->Filtro($_REQUEST['']));
$registradatosobra->set_gastogeneralpresupuestocontractual($limpia->Filtro($_REQUEST['']));
$registradatosobra->set_utilidadpresupuestocontractual($limpia->Filtro($_REQUEST['']));
$registradatosobra->set_gastogeneralordenescambio($limpia->Filtro($_REQUEST['']));
$registradatosobra->set_utilidadordenescambio($limpia->Filtro($_REQUEST['']));

$registradatosobra->set_provevedorafacturar();

/**
 * PARAMETROS OBRAS (PARA PROVEEDORES)
 */
$registradatosobra->set_porcentajecartafianza($limpia->Filtro($_REQUEST['']));
$registradatosobra->set_diashabilesdesembolso($limpia->Filtro($_REQUEST['']));
$registradatosobra->set_porcentajefondoretencion($limpia->Filtro($_REQUEST['']));
$registradatosobra->set_diashabilesdevolucion($limpia->Filtro($_REQUEST['']));
$registradatosobra->set_montomayor($limpia->Filtro($_REQUEST['']));
$registradatosobra->set_montomenor($limpia->Filtro($_REQUEST['']));

/**
 * MODELOS DE CARTA 
 */
$registradatosobra->set_modelocartaadjudicacion();
        $registradatosobra->set_modelocontrato();