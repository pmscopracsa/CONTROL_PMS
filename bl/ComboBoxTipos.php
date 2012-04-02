<?php

class ComboBoxTipos extends ComboBoxSql
{
    protected $codigo_seleccion;
    
    public function cargaTipoCompania()
    {
        $consulta = parent::__construct();
        $consulta = parent::consulta("SELECT * FROM TipoCompania ORDER BY nombre ASC");
        $num_total_registros = parent::num_rows($consulta);
        
        if ($num_total_registros > 0) {
            $tipocompanias = array();
            
            while ($tipocompania = parent::fetch_assoc($consulta)) {
                $id = $tipocompania['id'];
                $descripcion = $tipocompania['nombre'];
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
        $consulta = parent::consulta("SELECT * FROM ViaEnvio ORDER BY nombre ASC");
        $num_total_registros = parent::num_rows($consulta);
        
        if ($num_total_registros > 0) {
            $viasenvio = array();
            
            while ($viaenvio = parent::fetch_assoc($consulta)) {
                $id = $viaenvio['id'];
                $descripcion = $viaenvio['nombre'];
                $viasenvio[$id] = $descripcion;
            }
            return $viasenvio;
        }  else {
            return FALSE;
        }
    }
    
    public function cargarTipoDireccion()
    {
        $consulta = parent::__construct();
        $consulta = parent::consulta("SELECT * FROM  TipoDireccion ORDER BY descripcion ASC");
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
}

?>
