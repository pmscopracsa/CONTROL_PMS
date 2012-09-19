<?php
include_once '../../dl/busca_persona/RegistraPersona.php';
include_once '../../dl/funciones/LimpiarVariable.php';

$registrapersona = new RegistraPersona();
$limpia = new LimpiarVariable();

/**
 * OBTENER DATOS SEGUN FORMULARIO Y SANITIZARLAS 
 */
$registrapersona->set_idempresa($_REQUEST['idEmpresa']);
$registrapersona->set_tipodocumento($_REQUEST['tipo-documento']);
$registrapersona->set_numerodocumento($_REQUEST['numero-documento'] == "" ? "NULL" : $limpia->Filtro($_REQUEST['numero-documento']));

/**
 * VERIFICA SI EXISTE RUC 
 */
if ($_REQUEST['tieneruc'] == "si") {
    $registrapersona->set_hasruc($_REQUEST['tieneruc']);
    $registrapersona->set_ruc($_REQUEST['ruc'] == "" ? "NULL" : $limpia->Filtro($_REQUEST['ruc']));
} else {
    $registrapersona->set_hasruc("no");
    $registrapersona->set_ruc("NULL");
}

$registrapersona->set_nombrecompleto($_REQUEST['nombre'] == "" ? "NULL" : $limpia->Filtro($_REQUEST['nombre']));
$registrapersona->set_tbcompaniaid($_REQUEST['txtidempresa']);
$registrapersona->set_cargo($_REQUEST['cargo'] == "" ? "NULL" :$limpia->Filtro($_REQUEST['cargo']));

/**
 * VALIDACION DE EXISTENCIA DE TELEFONOS FIJOS 
 */
if ($_REQUEST['telefonofijo1'] != "") {
    $tfijo_ = array();
    for ($i = 1; $i <= $_REQUEST['filas_tfijo']; $i++) {
        array_push($tfijo_, $limpia->Filtro($_REQUEST['telefonofijo'.$i]));
    }
    $registrapersona->set_telefonoFijo($tfijo_);//array
}

/**
 * VALIDACION DE EXITENCIA DE TELEFONOS MOBILES 
 */
if ($_REQUEST['telefonomovil1'] != "") {
    $tmobile_ = array();
    for ($i = 1; $i <= $_REQUEST['filas_tmovil']; $i++) {
        array_push($tmobile_, $limpia->Filtro($_REQUEST['telefonomovil'.$i]));
    }
    $registrapersona->set_telefonomobile($tmobile_);//array
}

/**
 * VALIDACION DE EXITENCIA DE TELEFONO NEXTEL 
 */
if ($_REQUEST['telefononextel1'] != "") {
    $tnextel_ = array();
    for ($i = 1; $i <= $_REQUEST['filas_tnextel']; $i++) {
        array_push($tnextel_, $limpia->Filtro($_REQUEST['telefononextel'.$i]));
    }
    $registrapersona->set_telefononextel($tnextel_);//array
}

$registrapersona->set_direccion($limpia->Filtro($_REQUEST['direccion']));
$registrapersona->set_pais($_REQUEST['paisseleccionada']);
$registrapersona->set_departamento($_REQUEST['departamentoseleccionada']);
$registrapersona->set_distrito($_REQUEST['distritoseleccionada']);

/**
 * VALIDA EXITENCIA DE ESPECIALIDADES 
 */
if ($_REQUEST['cont_especialidades'] > 0) {
    $especialidad_ = array();
    for ($i = 1; $i <= $_REQUEST['cont_especialidades']; $i++) {
        array_push($especialidad_, $_REQUEST['especialidad'.$i]);
    }
    $registrapersona->set_tbespecialidadid($especialidad_);//array
}

/**cont_direccionestrabajo
 * VALIDA EXISTENCIA DE DIRECCIONES DE TRABAJO
 */
if ($_REQUEST['cont_direccionestrabajo'] > 0) {
    $direccion_trabajo = array();
    for ($i = 1; $i<= $_REQUEST['cont_direccionestrabajo']; $i++) {
        array_push($direccion_trabajo, $_REQUEST['direlaboral'.$i]);
    }
    $registrapersona->setTb_direcciontrabajo($direccion_trabajo);//array
}


$registrapersona->set_observacion($_REQUEST['observacion'] == "" ? "NULL" : $limpia->Filtro($_REQUEST['observacion']));
$registrapersona->set_emailprincipal($_REQUEST['email'] == "" ? "NULL" : $limpia->Filtro($_REQUEST['email']));

/**
 * VALIDACION DE EXISTENCIA DE EMAIL SECUNDARIOS 
 */
if ($_REQUEST['emailsecundario1'] != "") {
    $emailsecundarios = array();
    for ($i = 1; $i <= $_REQUEST['filas_emailsecundario']; $i++) {
        array_push($emailsecundarios, $limpia->Filtro($_REQUEST['emailsecundario'.$i]));
    }
    $registrapersona->set_emailsecundarios($emailsecundarios);
}

$registrapersona->set_web($_REQUEST['web'] == "" ? "NULL" : $limpia->Filtro($_REQUEST['web']));
$registrapersona->set_fax($_REQUEST['fax'] == "" ? "NULL" : $limpia->Filtro($_REQUEST['fax']));
$registrapersona->set_tbviaenvioid($_REQUEST['viaenvioseleccionada']);

$registrapersona->i_RegistraPersona();
//$registrapersona->prueba();