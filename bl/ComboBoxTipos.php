<?php
class ComboBoxTipos extends ComboBoxSql
{
    protected $codigo_seleccion;
    
    public function cargaTipoCompania()
    {
        $consulta = parent::__construct();
        $consulta = parent::consulta("SELECT * FROM tb_tipocompania ORDER BY descripcion ASC");
        $num_total_registros = parent::num_rows($consulta);
        
        if ($num_total_registros > 0) {
            $tipocompanias = array();
            
            while ($tipocompania = parent::fetch_assoc($consulta)) {
                $id = $tipocompania['id'];
                $descripcion = $tipocompania['descripcion'];
                $tipocompanias[$id] = $descripcion;
            }
            return $tipocompanias;
        }  else {
            return FALSE;
        }
    }
    
    public function cargarTipoEnvio()
    {
        $consulta = parent::__construct();
        $consulta = parent::consulta("SELECT * FROM tb_viaenvio ORDER BY descripcion ASC");
        $num_total_registros = parent::num_rows($consulta);
        
        if ($num_total_registros > 0) {
            $viasenvio = array();
            
            while ($viaenvio = parent::fetch_assoc($consulta)) {
                $id = $viaenvio['id'];
                $descripcion = $viaenvio['descripcion'];
                $viasenvio[$id] = $descripcion;
            }
            return $viasenvio;
        }  else {
            return FALSE;
        }
    }
    
    public function cargarTipoDocumento()
    {
        $consulta = parent::__construct();
        $consulta = parent::consulta("SELECT * FROM tb_tipodocumento ORDER BY descripcion ASC");
        $num_total_registros = parent::num_rows($consulta);
        
        if ($num_total_registros > 0) {
            $tiposdocumento = array();
            
            while ($tipodocumento = parent::fetch_assoc($consulta)) {
                $id = $tipodocumento['id'];
                $descripcion = utf8_encode($tipodocumento['descripcion']);
                $tiposdocumento[$id] = $descripcion;
            }
            return $tiposdocumento;
        } else {
            return FALSE;
        }
    }
    
    public function cargarTipoDireccion()
    {
        $consulta = parent::__construct();
        $consulta = parent::consulta("SELECT * FROM tb_tipodireccion ORDER BY descripcion ASC");
        $total_registros = parent::num_rows($consulta);
        
        if ($total_registros > 0) {
            $tiposdireccion = array();
            
            while ($tipodireccion = parent::fetch_assoc($consulta)) {
                $id = $tipodireccion['id'];
                $descripcion = $tipodireccion['descripcion'];
                $tiposdireccion[$id] = $descripcion;
            }
            return $tiposdireccion;
        }  else {
            return FALSE;
        }
    }
    
    public function cargarMoneda()
    {
        $consulta = parent::__construct();
        $consulta = parent::consulta("SELECT * FROM tb_moneda ORDER BY descripcion ASC");
        $total_registros = parent::num_rows($consulta);
        
        if ($total_registros > 0) {
            $monedas = array();
            
            while ($moneda = parent::fetch_assoc($consulta)) {
                $id = $moneda['id'];
                $descripcion = $moneda['descripcion'];
                $monedas[$id] = $descripcion;
            }
            return $monedas;
        }  else {
            return FALSE;
        }
    }
    
    public function cargarTipoValorizacion()
    {
        $consulta = parent::__construct();
        $consulta = parent::consulta("SELECT * FROM tb_tipovalorizacion ORDER BY descripcion ASC");
        $total_registros = parent::num_rows($consulta);
        
        if ($total_registros > 0) {
            $tipovalorizaciones = array();
            
            while ($tipovalorizacion = parent::fetch_assoc($consulta)) {
                $id = $tipovalorizacion['id'];
                $descripcion = $tipovalorizacion['descripcion'];
                $tipovalorizaciones[$id] = $descripcion;
            }
            return $tipovalorizaciones;
        } else {
            return FALSE;
        }
    }
    
    public function cargarFormatoPresupuesto()
    {
        $consulta = parent::__construct();
        $consulta = parent::consulta("SELECT * FROM tb_formatopresupuesto ORDER BY descripcion ASC");
        $total_registros = parent::num_rows($consulta);
        
        if ($total_registros > 0) {
            $formatospresupuesto = array();
            
            while ($formatopresupuesto = parent::fetch_assoc($consulta)) {
                $id = $formatopresupuesto['id'];
                $descripcion = $formatopresupuesto['descripcion'];
                $formatospresupuesto[$id] = $descripcion;
            }
            return $formatospresupuesto;
        } else {
            return FALSE;
        }
    }
    
    public function cargarDirectoriosEditar($id_empresa)
    {
        $consulta = parent::__construct();
        $consulta = parent::consulta("SELECT id,descripcion FROM tb_directorio WHERE tb_empresa_id = $id_empresa ORDER BY descripcion");
        $total_registros = parent::num_rows($consulta);
        
        if ($total_registros > 0) {
            $directorios = array();
            
            while ($directorio = parent::fetch_assoc($consulta)) {
                $id = $directorio['id'];
                $descripcion = $directorio['descripcion'];
                $directorios[$id] = $descripcion;
            }
            return $directorios;
        } else {
            return FALSE;
        }
    }
    
    public function cargarEspecialidades()
    {
        $consulta = parent::__construct();
        $consulta = parent::consulta("SELECT id, descripcion FROM tb_especialidadcompania");
        $total_registros = parent::num_rows($consulta);
        
        if ($total_registros > 0) {
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
    
    public function cargarRepresentantes()
    {
        $consulta = parent::__construct();
        $consulta = parent::consulta("SELECT id, nombre FROM tb_personacontacto");
        $total_registros = parent::num_rows($consulta);
        
        if ($total_registros > 0) {
            $representantes = array();
            
            while ($representante = parent::fetch_assoc($consulta)) {
                $id = $representante['id'];
                $descripcion = $representante['nombre'];
                $representantes[$id] = $descripcion;
            }
            return $representantes;
        } else {
            return FALSE;
        }
    }
}