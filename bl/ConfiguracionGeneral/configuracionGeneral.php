<?php
setlocale(LC_ALL, "es_ES");

require_once '../../dl/ConfiguracionGeneral/TipoCambio.php';
$tipocambio = new TipoCambio();

$q = $_REQUEST['parametro'];

if ($q == "existecambio") {
    $tipocambio->set_tb_empresa_id($_REQUEST['id_empresa']);
    echo $tipocambio->existecambio();
} elseif ($q == "seteocambiomoneda") {
    $tipocambio->set_sunatventa($_REQUEST['ventasunat']);
    $tipocambio->set_sunatcompra($_REQUEST['comprasunat']);
    $tipocambio->set_tb_moneda_id($_REQUEST['idmoneda']);
    $tipocambio->set_bancoventa($_REQUEST['ventasunat']);
    $tipocambio->set_tb_empresa_id($_REQUEST['idempresa']);
    
    $tipocambio->c_tipocambio();
} elseif ($q == "cargarcambio") {
    $tipocambio->set_tb_empresa_id($_REQUEST['idempresa']);
    $cambio = array();
    $cambio = $tipocambio->r_tipocambio();
    
    $definiciones = array('Venta Sunat','Compra Sunat', 'Venta Banco');
    $html = "";
    for ($i = 0; $i < sizeof($cambio); $i++) {
        $html .= $definiciones[$i]." "."<a>";
        $html .= $cambio[$i];
        $html .="</a> ";
    }
    echo "Tipo de de cambio a la fecha: ".  strftime("%A %d de %B del %Y")."<br />".$html;
}