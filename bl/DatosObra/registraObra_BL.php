<?php
include_once '../../dl/datos_obra/RegistraDatosObra.php';
include_once '../../dl/funciones/LimpiarVariable.php';

$registradatosobra = new RegistraDatosObra();
$limpia = new LimpiarVariable();

/**
 * DATOS INICIALES  
 */
$registradatosobra->set_nombre($limpia->Filtro($_REQUEST['codigo']));
$registradatosobra->set_finicio($_REQUEST['f_inicio']);
$registradatosobra->set_ffin($_REQUEST['f_fin']);
$registradatosobra->set_direccionobra($limpia->Filtro($_REQUEST['direccion_obra']));
$registradatosobra->set_tbdepartamentoid($_REQUEST['departamento']);
$registradatosobra->set_tbmonedaid($_REQUEST['moneda']);

$registradatosobra->set_tbclienteid($_REQUEST['cliente--id']);
$registradatosobra->set_empresacontratante($_REQUEST['contratante--id']);

$registradatosobra->set_empresagerenteproyecto($_REQUEST['gerente--id']);
$registradatosobra->set_empresasupervisoraproyecto($_REQUEST['supervisor--id']);

/**
 * PARAMETROS PRESUPUESTO DE VENTAS
 */
$registradatosobra->set_tbtipovalorizacionid($_REQUEST['cmb_tipovalorizacion-name']);
$registradatosobra->set_tbformatopresupuesto($_REQUEST['cmb_formatopresupuesto-name']);
$registradatosobra->set_factorcoreccion($limpia->Filtro($_REQUEST['txt-factorcorreccion']));
$registradatosobra->set_retencionfondogarantia($limpia->Filtro($_REQUEST['txt-retenciongarantia']));
$registradatosobra->set_retencionfielcumplimiento($limpia->Filtro($_REQUEST['txt-retencioncumplimiento']));
$registradatosobra->set_gastogeneralpresupuestocontractual($limpia->Filtro($_REQUEST['txt-gastogeneral_pc']));
$registradatosobra->set_utilidadpresupuestocontractual($limpia->Filtro($_REQUEST['txt-utilidad_pc']));
$registradatosobra->set_gastogeneralordenescambio($limpia->Filtro($_REQUEST['txt-gastogeneral_oc']));
$registradatosobra->set_utilidadordenescambio($limpia->Filtro($_REQUEST['tx-utilidad_oc']));

$registradatosobra->set_provevedorafacturar();

/**
 * PARAMETROS OBRAS (PARA PROVEEDORES)
 */
$registradatosobra->set_porcentajecartafianza($limpia->Filtro($_REQUEST['txtsfcartafianza']));
$registradatosobra->set_diashabilesdesembolso($limpia->Filtro($_REQUEST['txtdias-desembolso']));
$registradatosobra->set_porcentajefondoretencion($limpia->Filtro($_REQUEST['txt_sffondoretencion']));
$registradatosobra->set_diashabilesdevolucion($limpia->Filtro($_REQUEST['txtdias-devolucion-fondoretencion']));
$registradatosobra->set_montomayor($limpia->Filtro($_REQUEST['txt_sfmontomayora']));
$registradatosobra->set_montomenor($limpia->Filtro($_REQUEST['txtsfmonotmenora']));

/**
 * MODELOS DE CARTA 
 */
$registradatosobra->set_modelocartaadjudicacion($_REQUEST['carta--id']);
$registradatosobra->set_modelocontrato($_REQUEST['contrato--id']);