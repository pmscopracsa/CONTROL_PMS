<?php
require_once '../dl/Conexion.php';
require_once '../dl/OpcionesTop.php';

$opcionestop = new OpcionesTop();

try {
    $cnx = new Conexion();
    $cn = $cnx->conectar();
    if (!$cn)
    throw new Exception("Error al conectar a la DB: " . mysql_error());
    
    if ($_REQUEST['parameter'] === "listarOpcionesTH") {
        $opcionestop->listarOpcionesTopTH($cn);
    }
} catch(Exception $ex) {
    echo 'Error: '.$ex->getMessage();
}

