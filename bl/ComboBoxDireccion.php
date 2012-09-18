<?php

class ComboBoxDireccion extends ComboBoxSql
{
    protected $codigo_seleccion;
    
    function cargarPais()
    {
        $consulta = parent::__construct();
        $consulta = parent::consulta("SELECT * FROM tb_pais ORDER BY nombre DESC");
        $num_total_registros = parent::num_rows($consulta);
        
        if ($num_total_registros > 0) {
            $paises = array();
            
            while ($pais = parent::fetch_assoc($consulta)) {
                $id_pais = $pais['id'];
                $nombre_pais = $pais['nombre'];
                $paises[$id_pais] = $nombre_pais;
            }
            return $paises;
        } else {
            return FALSE;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
        }
    }
    
    function cargarDepartamento()
    {
        $consulta = parent::__construct();
        $consulta = parent::consulta("SELECT * FROM tb_departamento WHERE tb_pais_id = $this->codigo_seleccion ORDER BY nombre ASC");
        //$consulta = parent::consulta("SELECT * FROM tb_departamento ORDER BY nombre DESC");
        $num_total_registros = parent::num_rows($consulta);                                                                                 
        
        if ($num_total_registros > 0) {
            $departamentos = array();
            
            while ($departamento = parent::fetch_assoc($consulta)) {
                $id_departamento = $departamento['id'];
                $descripcion_departamento = $departamento['nombre'];
                $departamentos[$id_departamento] = $descripcion_departamento;                                                                                                                           
            }
            return $departamentos;
        }  else {
            return FALSE;
        }
    }
    
    function cargarDepartamentosSelected()
    {
        $consulta = parent::__construct();
        //$consulta = parent::consulta("SELECT *  FROM tb_departamento where tb_pais_id = 177 ORDER BY nombre ASC");
        $consulta = parent::consulta("SELECT * FROM tb_departamento ORDER BY ordena_cod DESC");
        $num_total_registros = parent::num_rows($consulta);
        
        if ($num_total_registros > 0)
        {
            $departamentos = array();
            while ($departamento = parent::fetch_assoc($consulta)) {
                $id = $departamento['id'];
                $nombre = $departamento['nombre'];
                $departamentos[$id] = $nombre;
            }
            return $departamentos;
        } else {
            return FALSE;
        }
    }
    
    function cargarDistrito()
    {
        $consulta = parent::__construct();
        $consulta = parent::consulta("SELECT * FROM tb_distrito WHERE tb_departamento_id = $this->codigo_seleccion ORDER BY nombre ASC");
        //$consulta = parent::consulta("SELECT * FROM tb_distrito ORDER BY nombre DESC");
        
        $num_total_registros = parent::num_rows($consulta);
        
        if ($num_total_registros > 0) 
        {
            $distritos = array();
            
            while($distrito = parent::fetch_assoc($consulta))
            {
                $id_distrito = $distrito['id'];
                $descripcion_distrito = $distrito['nombre'];
                $distritos[$id_distrito] = $descripcion_distrito;
            }
            return $distritos;
        }  else {
            return FALSE;
        }
    }
    
        function cargarDistritoSelected()
    {
        $consulta = parent::__construct();
        //$consulta = parent::consulta("SELECT * FROM tb_distrito WHERE tb_departamento_id = $this->codigo_seleccion ORDER BY nombre ASC");
        $consulta = parent::consulta("SELECT * FROM tb_distrito ORDER BY nombre DESC");
        
        $num_total_registros = parent::num_rows($consulta);
        
        if ($num_total_registros > 0) 
        {
            $distritos = array();
            
            while($distrito = parent::fetch_assoc($consulta))
            {
                $id_distrito = $distrito['id'];
                $descripcion_distrito = $distrito['nombre'];
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
