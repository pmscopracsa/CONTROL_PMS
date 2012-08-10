<?php
require_once '../../dl/datos_obra/FaseVenta.php.php';
$fase = new FaseVenta();

$fase->set_codificacion($_REQUEST['']);
$fase->set_descripcion($_REQUEST['']);
$fase->set_tb_seccionventa_id($_REQUEST['']);

$fase->c_fase();