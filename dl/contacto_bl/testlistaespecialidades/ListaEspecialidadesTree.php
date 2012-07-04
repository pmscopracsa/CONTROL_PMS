<?php
require_once 'Conexion.php';

class ListaEspecialidadesTree {
    
    public function listaEspecialidades()
    {   
        try {
            $conexion = new Conexion();
            $ch = $conexion->conectar();
            
            if ( !$ch ) 
                throw new Exception("Error en conexion. ListaEspecialidadesTree. Error: ".  mysql_error());
            
            $sql = "SELECT id,descripcion FROM tb_especialidadcompania ORDER BY descripcion";
            $rs = mysql_query($sql);
            
            $especialidades = array();
            $i = 0;
            while ( $res = mysql_fetch_assoc($rs) ) {
                $especialidades[$i]['id'] = $res['id'];
                $especialidades[$i]['descripcion'] = $res['descripcion'];
                $i++;
            }
            
            echo json_encode($especialidades);
            
            if ( !$rs ) 
                throw new Exception("Error en consulta. ListaEspecialidadesTree. Error: ".  mysql_error());
        } catch ( Exception $ex ) {
            echo "Mensaje de error: ".$ex->getMessage();
        }
    }
}