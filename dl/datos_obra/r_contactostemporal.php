<?php
include_once 'Conexion.php';

try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    if (!$cn) 
        throw new Exception ("Problemas en la conexion a la DDBB: ".  mysql_error());
    
    $sql = "SELECT a.nombre nombre, c.descripcion descripcion FROM tb_personacontacto a
        INNER JOIN temporal  b
        ON a.id = b.id_contacto
        INNER JOIN tb_companiacontacto c
        ON a.tb_companiacontacto_id = c.id";
    
    $res = mysql_query($sql,$cn);
    $contacto = array();
    $i = 0;
    
    while ($rs = mysql_fetch_assoc($res)) {
        $contacto[$i]['nombre'] = $rs['nombre'];
        $contacto[$i]['descripcion'] = $rs['descripcion'];
        $i++;
    }
    echo json_encode($contacto);
    
    if (!$res)
        throw new Exception("Problemas en la seleccion de la data: ".  mysql_error());
} catch ( Exception $ex ) {
    echo "-> ".$ex->getMessage(); 
}