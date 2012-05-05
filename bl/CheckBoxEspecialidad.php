<?php

class CheckBoxEspecialidad  extends CheckBoxSql
{
    function cargarEspecialidad()
    {
        $consulta = parent::__construct();
        $consulta = parent::consulta("SELECT * FROM EspecialidadCompania ORDER BY descripcion ASC");
        $num_total_registros = parent::num_rows($consulta);
        
        if($num_total_registros > 0)
        {
            $especialidades = array();
            
            while($especialidad = parent::fetch_assoc($consulta)) {
                $id = $especialidad['id'];
                $descripcion = $especialidad['descripcion'];
                $especialidades[$id] = $descripcion;
            }
            return $especialidades;
        } else {
            return FALSE;
        }
    }
    
    
}

?>
