<?php
setlocale(LC_ALL, "es_ES");

require_once '../../dl/ConfiguracionGeneral/TipoCambio.php';
require_once '../../dl/ConfiguracionGeneral/Session.php';
$tipocambio = new TipoCambio();
$session = new Session();

if ($_REQUEST['parametro'] == "existecambio") {
    $tipocambio->set_tb_empresa_id($_REQUEST['id_empresa']);
    echo $tipocambio->existecambio();
    exit;
} elseif ($_REQUEST['parametro'] == "seteocambiomoneda") {
    // SESSION
    $session->set_id_empresa($_REQUEST['idempresa']);
    $session->set_id_usuario($_REQUEST['id_usuario']);
    $session->set_directorio($_REQUEST['id_directorio']);
    $session->set_obra($_REQUEST['id_obra']);

    $rs = $session->guardarDirectorioObraSeteoTrabajo();
    echo $rs;
    sleep(5);
    
    $tipocambio->set_sunatventa($_REQUEST['ventasunat']);
    $tipocambio->set_sunatcompra($_REQUEST['comprasunat']);
    $tipocambio->set_tb_moneda_id($_REQUEST['idmoneda']);
    $tipocambio->set_tb_empresa_id($_REQUEST['idempresa']);
    
    $tipocambio->c_tipocambio();
    

} 
elseif ($_REQUEST['parametro'] == "cargarcambio") {
    $tipocambio->set_tb_empresa_id($_REQUEST['idempresa']);
    $cambio = array();
    $cambio = $tipocambio->r_tipocambio();
    
    $definiciones = array('Venta Sunat','Compra Sunat');
    $html = "";
    for ($i = 0; $i < 2; $i++) {
        $html .= $definiciones[$i]." "."<a>";
        $html .= $cambio[$i];
        $html .="</a> ";
    }
    echo "Tipo de de cambio a la fecha: ".  strftime("%A %d de %B del %Y")."<br />".$html;
} 
elseif ($_REQUEST['parametro'] == "salvardirectorioobra") {
    // SESSION
    $session->set_id_empresa($_REQUEST['id_empresa']);
    $session->set_id_usuario($_REQUEST['id_usuario']);
    $session->set_id_rol($_REQUEST['rol_usuario']);
    $session->guardarDirectorioObraSeteoTrabajo();
} elseif ($_REQUEST['parametro'] == "saveCurrentChange") {
    $tipocambio->set_sunatventa($_REQUEST['ventasunat']);
    $tipocambio->set_sunatcompra($_REQUEST['comprasunat']);
    $tipocambio->set_tb_moneda_id($_REQUEST['idmoneda']);
    $tipocambio->set_tb_empresa_id($_REQUEST['idempresa']);
    
    $tipocambio->c_tipocambio();
}