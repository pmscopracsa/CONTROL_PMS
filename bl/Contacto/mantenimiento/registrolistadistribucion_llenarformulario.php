<?php
/**
 * LLENAR FORMULARIO POR ID DE LISTA 
 */
/*
require_once '../../../dl/Conexion.php';

try {
    
    $script = $_SERVER['PHP_SELF'];
    $path_info = pathinfo($script);
    
    $id_listadistribucion = $_REQUEST['id'];
    
    $cone = new Conexion();
    $cn = $cone->conectar();
    
    if (!$cn)
        throw new Exception("Error en la conexion. Archivo: ".$path_info['basename']." Error DB: ".  mysql_error(). "\n");
    
    $sql = "SELECT * FROM tb_listadistribucioncontacto WHERE id = $id_listadistribucion AND tb_empresa_id = 1";
    $rs = mysql_query($sql);
    
    if (!$rs)
        throw new Exception("Error en la consulta. Archivo: ".$path_info['basename']." Error DB: ".  mysql_error(). "\n");
    
    $especialidad = array();
    $i = 0;
    while ($registro = mysql_fetch_array($rs)) {
        $especialidad[$i]['id'] = $registro['id'];
        $especialidad[$i]['tb_empresa_id'] = $registro['tb_empresa_id'];
        $especialidad[$i]['descripcion'] = $registro['descripcion'];
        $especialidad[$i]['codigoobra'] = $registro['codigoobra'];
        $especialidad[$i]['observacion'] = $registro['observacion'];
        $i++;
    }
    echo json_encode($especialidad);
} catch ( Exception $ex ) {
    echo "Mensaje de error :\n".$ex->getMessage()."\n";
}*/
                    echo"<tr>";
                    echo"<td>HOLA</td>";
                    echo"<td>ADIOS</td>";
                    echo"<td><a href='#' id='del-contacto' class='button delete'>Eliminar</a></td>";
                    echo'<input type="hidden" name="contacto" value="" /></tr>';    