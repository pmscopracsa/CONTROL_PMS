<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

require_once '../../dl/busca_persona/RegistraCompania.php';
$rcompania = new RegistraCompania();
$rcompania->set_idempresa($_SESSION['id']);
$res = array();

if ($_REQUEST['opcion'] == "ruc") 
{
    $rcompania->set_ruc($_REQUEST['ruc']);
    $res = $rcompania->s_buscaCompaniaPorRuc();
    var_dump(json_decode($res));
}
elseif ($_REQUEST['opcion'] == "nombre") {
    $rcompania->set_descripcion($_REQUEST['nombre']);
    $res = $rcompania->s_buscarCompaniaPorNombre();
    print_r($res);
}