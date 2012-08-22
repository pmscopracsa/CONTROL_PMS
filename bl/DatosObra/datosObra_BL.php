<?php
require_once '../../dl/Conexion.php';
require_once '../../dl/ObraCliente.php';



try {
    $cnx = new Conexion();
    $cn = $cnx->conectar(); 
    if (!$cn)
        throw new Exception("Error al conectar con la db: ".  mysql_error());
    
    $obracliente = new ObraCliente();
    
    if ($_REQUEST['parameter']  === "cargarDatosIniciales") {
        $obracliente->set_id($_REQUEST['id_obra']);
        $obracliente->mostrarDatosBasicos($cn);
    }
} catch (Exception $ex) {
    echo 'Error: '.$ex->getMessage();
}

