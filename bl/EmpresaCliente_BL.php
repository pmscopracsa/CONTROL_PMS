<?php
require_once '../dl/Conexion.php';
require_once '../dl/EmpresaCliente.php';
$conex = new Conexion();
$cn = $conex->conectar();
$empresa = new EmpresaCliente();

if ($_REQUEST['parameter'] == 'existePassword') {
    $empresa->set_id($_REQUEST['id_empresa']);
    $empresa->set_password($_REQUEST['old_pass']);
    $rs = $empresa->existePassword($cn);
    echo $rs;
} elseif ($_REQUEST['parameter'] == 'resetpassword') {
    $empresa->set_id($_REQUEST['id_empresa']);
    $empresa->set_password($_REQUEST['new_pass']);
    $rs = $empresa->resetPassword($cn);
    echo $rs;
}