<?php
include_once 'Conexion.php';

try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    if ( !$cn )
        throw new Exception("Error al conectar: ".  mysql_error());
} catch( Exception $ex ) {
    echo "Mensaje de error: " . $ex->getMessage();
}