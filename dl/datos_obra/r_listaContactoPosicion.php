<?php
include_once 'Conexion.php';
$aleatorio = $_REQUEST['aleatorio'];
try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    if ( !$cn )
        throw new Exception("Error al conectar: ".  mysql_error());
    //$sql = "SELECT * FROM tb_firmascontactotemporal WHERE aleatorio = ".$aleatorio;
    $sql = "SELECT fct.id_contacto id_contacto, fct.txt_puesto txt_puesto,pc.nombre nombre_contacto, fct.aleatorio aleatorio 
    FROM tb_firmascontactotemporal fct 
    INNER JOIN tb_personacontacto pc
    ON fct.id_contacto = pc.id
    WHERE aleatorio =".$aleatorio;
    
    $rs = mysql_query($sql);
    if (!$rs)
        throw new Exception("Error en la consulta");
    
    $a_firmar = array();
    $i = 0;
    while ($res = mysql_fetch_assoc($rs)) {
        $a_firmar[$i]['txt_puesto'] = $res['txt_puesto'];
        $a_firmar[$i]['nombre_contacto'] = $res['nombre_contacto'];
        $a_firmar[$i]['id_contacto'] = $res['id_contacto'];
        $i++;
    }
    echo json_encode($a_firmar);
} catch( Exception $ex ) {
    echo "Mensaje de error: " . $ex->getMessage();
}