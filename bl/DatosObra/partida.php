<?php
require_once '../../dl/datos_obra/PartidaVenta.php';
$partida = new PartidaVenta();

$partida->set_codificacion($_REQUEST['']);
$partida->set_descripcion($_REQUEST['']);
$partida->set_unidadmedida($_REQUEST['']);
$partida->set_metrado($_REQUEST['']);
$partida->set_precio($_REQUEST['']);
$partida->set_parcial($_REQUEST['']);
$partida->set_tb_faseventa_id($_REQUEST['']);