<?php
require_once '../../dl/Ayuda.php';

$ayuda = new Ayuda();
//$ayuda->set_nombre_usuario($_REQUEST['nombre_usuario']);
//$ayuda->set_nombre_tabla($_REQUEST['nombre_tabla']);
//$ayuda->set_nombre_campo($_REQUEST['nombre_campo']);
//$ayuda->existeUsuario();

if ($_REQUEST['recover'] == 'empresa') {
    $ayuda->set_nombre_usuario($_REQUEST['nombre_usuario']);
    $ayuda->set_nombre_tabla('tb_empresa');
    $ayuda->set_nombre_campo('nombre');
    $ayuda->existeUsuario();
}elseif ($_REQUEST['recover'] == 'usuario') {
    $ayuda->set_nombre_usuario($_REQUEST['nombre_usuario']);
    $ayuda->set_nombre_tabla('tb_usuario');
    $ayuda->set_nombre_campo('nombreusuario');
    $ayuda->existeUsuario();
}