<?php
include_once '../../dl/busca_persona/RegistraCompania.php';
include_once '../../dl/funciones/LimpiarVariable.php';

$registracompania = new RegistraCompania();
$limpia = new LimpiarVariable();
/**
 * REGISTRA SEGUN ESTRUCTURA DE FORMULARIO 
 */
$registracompania->set_descripcion($_REQUEST['nombre'] == "" ? "NULL" : $limpia->Filtro($_REQUEST['nombre']));
$registracompania->set_ruc($_REQUEST['ruc'] == "" ? "NULL" : $limpia->Filtro($_REQUEST['ruc']));
$registracompania->set_nombrecomercial($_REQUEST['nombrecomercial'] == "" ? "NULL" : $limpia->Filtro($_REQUEST['nombrecomercial']));
$registracompania->set_partidaregistral($_REQUEST['partidaregistral'] == "" ? "NULL" : $limpia->Filtro($_REQUEST['partidaregistral']));
$registracompania->set_actividadprincipal($_REQUEST['actividadprincipal'] == "" ? "NULL" : $limpia->Filtro($_REQUEST['actividadprincipal']));
$registracompania->set_tipocompania($limpia->Filtro($_REQUEST['tipocompaniaseleccionada']));
$registracompania->set_fax($_REQUEST['fax'] == "" ? "NULL" : $limpia->Filtro($_REQUEST['fax']));
$registracompania->set_observacion($_REQUEST['observacion'] == "" ? "NULL" : $limpia->Filtro($_REQUEST['observacion']));
$registracompania->set_email($_REQUEST['email'] == "" ? "NULL" : $limpia->Filtro($_REQUEST['email']));
$registracompania->set_web($_REQUEST['web'] == "" ? "NULL" : $limpia->Filtro($_REQUEST['web']));
$registracompania->set_viaenvio($_REQUEST['viaenvioseleccionada'] == "" ? "NULL" : $limpia->Filtro($_REQUEST['viaenvioseleccionada']));

/**
 * VALIDACION DE EXISTENCIA DE DATOS EN GIRO 
 */
if ($_REQUEST['giro1'] != "") {
    $giros_ = array();
    for ($i = 1; $i <= $_REQUEST['filas_giro']; $i++) {
        array_push($giros_, $limpia->Filtro($_REQUEST['giro'.$i]));
    }
    $registracompania->set_giro($giros_);
}

/**
 * VALIDACION DE EXISTENCIA DE TELEFONOS FIJOS 
 */
if ($_REQUEST['telefonofijo1'] != "") {
    $tfijo_ = array();
    for ($i = 1; $i <= $_REQUEST['filas_tfijo']; $i++) {
        array_push($tfijo_, $limpia->Filtro($_REQUEST['telefonofijo'.$i]));
    }
    $registracompania->set_telefonoFijo($tfijo_);//array
}

/**
 * VALIDACION DE EXITENCIA DE TELEFONOS MOBILES 
 */
if ($_REQUEST['telefonomovil1'] != "") {
    $tmobile_ = array();
    for ($i = 1; $i <= $_REQUEST['filas_tmovil']; $i++) {
        array_push($tmobile_, $limpia->Filtro($_REQUEST['telefonomovil'.$i]));
    }
    $registracompania->set_telefonoMobile($tmobile_);//array
}

/**
 * VALIDACION DE EXITENCIA DE TELEFONO NEXTEL 
 */
if ($_REQUEST['telefononextel1'] != "") {
    $tnextel_ = array();
    for ($i = 1; $i <= $_REQUEST['filas_tnextel']; $i++) {
        array_push($tnextel_, $limpia->Filtro($_REQUEST['telefononextel'.$i]));
    }
    $registracompania->set_telefonoNextel($tnextel_);//array
}

/**
 * VALIDA CANTIDAD DE DIRECCIONES 
 */
if ($_REQUEST['contador_direcciones'] > 0) {
    $direccion_ = array();
    $pais_ = array();
    $departamento_ = array();
    $tipodireccion_ = array();
    $distrito_ = array();
    
    for ($i = 1; $i <= $_REQUEST['contador_direcciones']; $i++) {
        array_push($direccion_, $limpia->Filtro($_REQUEST['direccion'.$i]));
        array_push($pais_, $_REQUEST['pais'.$i]);
        array_push($departamento_, $_REQUEST['departamento'.$i]);
        array_push($tipodireccion_, $_REQUEST['tipodireccion'.$i]);
        array_push($distrito_, $_REQUEST['distrito'.$i]);
    }
    $registracompania->set_cantdireccion($_REQUEST['contador_direcciones']);
    $registracompania->set_direccion($direccion_);
    $registracompania->set_pais($pais_);
    $registracompania->set_departamento($departamento_);
    $registracompania->set_tipodireccion($tipodireccion_);
    $registracompania->set_distrito($distrito_);
}

/**
 * VALIDA EXITENCIA DE ESPECIALIDADES 
 */
if ($_REQUEST['contador_especialidades'] > 0) {
    $especialidad_ = array();
    for ($i = 1; $i <= $_REQUEST['contador_especialidades']; $i++)
        array_push($especialidad_, $limpia->Filtro($_REQUEST['especialidad'.$i]));
    $registracompania->set_especialidad($especialidad_);//array
}

/**
 * VALIDA EXISTENCIA DE REPRESENTANTES 
 */
if ($_REQUEST['contador_representantes'] > 0) {
    $representante_ = array();
    for ($i = 1; $i <= $_REQUEST['contador_representantes']; $i++) {
        array_push($representante_, $_REQUEST['representante'.$i]);
    }
    $registracompania->set_representate($representante_);//array
}
$registracompania->i_RegistraCompania();
//$registracompania->prueba();