<?php
include_once '../../dl/busca_persona/RegistraCompania.php';
include_once '../funciones/LimpiarVariable.php';
$registracompania = new RegistraCompania();

/**
 * SANITIZAR LAS VARIABLES 
 */
$limpia = new LimpiarVariable();

/**
 * VARIABLES PARA LAS DIRECCIONES 
 */
$lista_tipodireccion = array();
$lista_direccion = array();
$lista_pais = array();
$lista_departamento = array();
$lista_distrito = array();

/**
 * VARIABLES PARA LOS TELEFONOS 
 */
$lista_tfijos = array();
$lista_tmoviles = array();
$lista_tnextel = array();

/**
 * VARIABLES PARA GIROS 
 */
$lista_giros = array();

/**
 * VARIABLES PARA ESPECIALIDAD 
 */
$lista_especialidades = array();

/**
 * VARIABLES PARA REPRESENTANTES 
 */
$lista_representantes = array();


/**
 * GIRO M:N 
 * BUG: EN LA CAPA DE PRESENTACION, debe eliminarse el ultimo que se ha ingresado
 */
if ($_REQUEST['giro1'] != "") {
    for ($i = 1; $i <= $_REQUEST['filas_giro']; $i++) {
        array_push($lista_giros, $limpia->Filtro($_REQUEST['giro'.$i]));
    }
}

/**
 * TELEFONOS FIJO / MOVIL / NEXTELM:N 
 * se asume que se eliminara de la manera lifo = ultimo en entrar primero en salir
 */
if ($_REQUEST['telefonofijo1'] != "") {
    for ($i = 1; $i <= $_REQUEST['filas_tfijo']; $i++){
        array_push($lista_tfijos, $limpia->Filtro($_REQUEST['telefonofijo'.$i]));
    }
}

if ($_REQUEST['telefonomovil1'] != "") {    
    for ($i = 1; $i <= $_REQUEST['filas_tmovil']; $i++){

        array_push($lista_tmoviles, $limpia->Filtro($_REQUEST['telefonomovil'.$i]));
    }
}

if ($_REQUEST['telefononextel1'] != "") {
    for ($i = 1; $i <= $_REQUEST['filas_tnextel']; $i++){
        array_push($lista_tnextel, $limpia->Filtro($_REQUEST['telefononextel'.$i]));
    }
}

/**
 * DIRECCION M:N 
 */
if ($_REQUEST['contador_direcciones'] >= 1) {
    for ($i = 1; $i <= $_REQUEST['contador_direcciones']; $i++) {
        array_push($lista_tipodireccion, $_REQUEST['tipodireccion'.$i]);
        array_push($lista_direccion, $limpia->Filtro($_REQUEST['direccion'.$i]));
        array_push($lista_pais,$_REQUEST['pais'.$i]);
        array_push($lista_departamento,$_REQUEST['departamento'.$i]);
        array_push($lista_distrito,$_REQUEST['distrito'.$i]);
    }
}

/**
 * ESPECIALIDAD M:N 
 */
if (($_REQUEST['contador_especialidades']) >= 1) {
    for ($i = 1; $i <= $_REQUEST['contador_especialidades']; $i++) {
        array_push($lista_especialidades, $_REQUEST['especialidad'.$i]);
    }
}

/**
 * REPRESENTANTE M:N 
 */
if ($_REQUEST['contador_representantes'] >= 1) {
    for ($i = 1; $i <= $_REQUEST['contador_representantes']; $i++) {
        array_push($lista_representantes,$_REQUEST['representante'.$i]);
    }
}

/**
 * N:N 
 */
$actividadprincipal = $limpia->Filtro($_REQUEST['actividadprincipal']);
$tipocompania = $_REQUEST['tipocompaniaseleccionada'];
$ruc = $limpia->Filtro($_REQUEST['ruc']);
$nombre = $limpia->Filtro($_REQUEST['nombre']);
$nombrecomercial = $limpia->Filtro($_REQUEST['nombrecomercial']);
$partidaregistral = $limpia->Filtro($_REQUEST['partidaregistral']);
$fax = $limpia->Filtro($_REQUEST['fax']);
$observacion = $limpia->Filtro($_REQUEST['observacion']);
$email = $limpia->Filtro($_REQUEST['email']);
$web = $limpia->Filtro($_REQUEST['web']);
$viaenvio = $_REQUEST['viaenvioseleccionada'];


/**
 * ENVIO DE VARIABLES A LA CAPA DE DATOS 
 * tb_companiacontacto
 */
$registracompania->set_descripcion($nombre);
$registracompania->set_ruc($ruc);
$registracompania->set_nombrecomercial($nombrecomercial);
$registracompania->set_partidaregistral($partidaregistral);
$registracompania->set_actividadprincipal($actividadprincipal);
$registracompania->set_tipocompania($tipocompania);
$registracompania->set_fax($fax);
$registracompania->set_observacion($observacion);
$registracompania->set_email($email);
$registracompania->set_web($web);
$registracompania->set_viaenvio($viaenvio);
$registracompania->set_idempresa($_REQUEST['id_empresa']); // no se sanitiza por ser una variable de session que viene de la DDBB

/**
 * SETEAR LA CANTIDAD DE DATOS QUE SE INGRESARAN EN LAS TABLAS N:M 
 * Si la primera variable esta en blanco, entonces la fila que se reporta
 * es la que por defecto se mtra en el formulario y no 1 que el usuario
 * haya ingresado. Si tiene datos este field entonces se pasa la cantidad que me diga el
 * formulario, pudiendo ser 1 o más
 */
$cant_giros = $_REQUEST['giro1'] != "" ? $_REQUEST['filas_giro'] : 0;
$cant_tfijo = $_REQUEST['telefonofijo1'] != "" ?  $_REQUEST['filas_tfijo'] : 0;
$cant_tmovil = $_REQUEST['telefonomovil1'] != "" ? $_REQUEST['filas_tmovil'] : 0;
$cant_tnextel = $_REQUEST['telefononextel1'] != "" ? $_REQUEST['filas_tnextel'] : 0;

$registracompania->set_cantgiros($cant_giros);
$registracompania->set_cantfijos($cant_tfijo);
$registracompania->set_cantmoviles($cant_tmovil);
$registracompania->set_cantnextel($cant_tnextel);
$registracompania->set_cantespecialidad($_REQUEST['contador_especialidades']);
$registracompania->set_cantrepresentante($_REQUEST['contador_representantes']);
$registracompania->set_cantdireccion($_REQUEST['contador_direcciones']);

/**
 * ENVIO DE VARIABLES EN ARREGLOS A LA CAPA DE DATOS
 * PARA N:M 
 */
$registracompania->set_giro($lista_giros);
$registracompania->set_telefonoFijo($lista_tfijos);
$registracompania->set_telefonoMobile($lista_tmoviles);
$registracompania->set_telefonoNextel($lista_tnextel);
$registracompania->set_especialidad($lista_especialidades);
$registracompania->set_representate($lista_representantes);

$registracompania->set_tipodireccion($lista_tipodireccion);
$registracompania->set_direccion($lista_direccion);
$registracompania->set_pais($lista_pais);
$registracompania->set_departamento($lista_departamento);
$registracompania->set_distrito($lista_distrito);
