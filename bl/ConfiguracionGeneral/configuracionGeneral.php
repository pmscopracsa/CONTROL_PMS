<?php
require_once '../../dl/ConfiguracionGeneral/TipoCambio.php';
$tipocambio = new TipoCambio();

$q = $_REQUEST['parametro'];

if ($q == "existecambio") {
    $tipocambio->set_tb_empresa_id($_REQUEST['id_empresa']);
    echo $tipocambio->existecambio();
}
elseif ($q == "seteocambio") {
    $tipocambio->set_sunatventa();
    $tipocambio->set_sunatcompra();
    $tipocambio->set_tb_moneda_id();
    $tipocambio->set_bancoventa();
    $tipocambio->set_tb_empresa_id();
}