<?php
include_once 'Conexion.php';
$id_obra = $_REQUEST['id_obra'];

try {
    $conexion = new Conexion();
    $cn = $conexion->conectar();
    if ( !$cn ) throw new Exception("Error al conectar: ".  mysql_error());
    
    $sql = "SELECT 
        f.posicion txt_puesto
        ,pc.nombre nombre_contacto
        ,pc.id id_contacto
        FROM tb_firma f
        INNER JOIN tb_personacontacto pc
        ON f.idcontacto = pc.id
        WHERE f.idobra = $id_obra";
    
    $rs = mysql_query($sql);
    if (!$rs) throw new Exception("Error en la consulta");
    
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