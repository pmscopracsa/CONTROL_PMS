<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

require_once '../../dl/datos_obra/RegistraDatosObra.php';
$robra = new RegistraDatosObra();
$robra->set_idempresa($_SESSION['id']);
$res = array();
$obras = array();

if ($_REQUEST['opcion'] == "codigo")
{
    $robra->set_codigo($_REQUEST['codigo']);
} elseif ($_REQUEST['opcion'] == "nombre") {
    $robra->set_nombre($_REQUEST['nombre']);
}

function toHtml($res)
{
    
}