<?php

class CheckBoxEspecialidadPersona extends CheckBoxSql
{
    function cargarEspecialidadPersona()
    {
        $query = "SELECT * FROM tb_especialidadpersona ORDER BY descripcion ASC";
        $consulta = parent::__construct();
        $consulta = parent::consulta($query);
        $num_total_registros = parent::num_rows($consulta);
        
        if ($num_total_registros > 0)
        {
            $especialidades_persona = array();
            
            while ($especialidad = parent::fetch_assoc($consulta)) {
                $id = $especialidad['id'];
                $descripcion = $especialidad['descripcion'];
                $especialidades_persona[$id] = $descripcion;
            }
            return $especialidades_persona;
        }
        else 
        {
            return FALSE;
        }
    }
}
?>