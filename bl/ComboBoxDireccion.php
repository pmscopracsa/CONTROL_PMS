<?php

class ComboBoxDireccion extends ComboBoxSql
{
    
    protected $codigo_seleccion;
    
    function cargarDepartamento()
    {
        $consulta = parent::__construct();
        $consulta = parent::consulta("SELECT * FROM Departamento ORDER BY descripcion ASC");
        $num_total_registros = parent::num_rows($consulta);
        
        if ($num_total_registros > 0) 
        {
            $departamentos = array();
            
            while ($departamento = parent::fetch_assoc($consulta)) {
                $id_departamento = $departamento['id'];
                $descripcion_departamento = $departamento['descripcion'];
                $departamentos[$id_departamento] = $descripcion_departamento;
            }
            return $departamentos;
        }  else {
            return FALSE;
        }
    }
    
    function cargarProvincia()
    {
        $consulta = parent::__construct();
        $consulta = parent::consulta("SELECT * FROM Provincia WHERE departamento_id = $this->codigo_seleccion ORDER BY descripcion ASC");
        $num_total_registros = parent::num_rows($consulta);
        
        if ($num_total_registros > 0) 
        {
            $provincias = array();
            
            while ($provincia = parent::fetch_assoc($consulta)) {
                $id_provincia = $provincia['id'];
                $descripcion_provincia = $provincia['descripcion'];
                $provincias[$id_provincia] = $descripcion_provincia;
            }
            return $provincias;
        }  else {
            return FALSE;
        }
    }
    
    function cargarDistrito()
    {
        $consulta = parent::__construct();
        $consulta = parent::consulta("SELECT * FROM Distrito WHERE provincia_id = $this->codigo_seleccion ORDER BY descripcion ASC");
        $num_total_registros = parent::num_rows($consulta);
        
        if ($num_total_registros > 0) 
        {
            $distritos = array();
            
            while($distrito = parent::fetch_assoc($consulta))
            {
                $id_distrito = $distrito['id'];
                $descripcion_distrito = $distrito['descripcion'];
                $distritos[$id_distrito] = $descripcion_distrito;
            }
            return $distritos;
        }  else {
            return FALSE;
        }
    }
    
    public function getCodigo_seleccion() {
        return $this->codigo_seleccion;
    }

    public function setCodigo_seleccion($codigo_seleccion) {
        $this->codigo_seleccion = $codigo_seleccion;
    }


}

?>
