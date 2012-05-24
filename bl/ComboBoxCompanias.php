<?php
class ComboBoxCompanias extends ComboBoxSql
{    
    public function cargaCompanias()
    {
        $consulta = parent::__construct();
        $consulta = parent::consulta("SELECT * FROM tb_companiacontacto ORDER BY descripcion ASC");
        $num_total_registros = parent::num_rows($consulta);
        
        if ($num_total_registros > 0) {
            $companias = array();
            
            while ($compania = parent::fetch_assoc($consulta)) {
                $id = $compania['id'];
                $descripcion = $compania['descripcion'];
                $companias[$id] = $descripcion;
            }
            return $companias;
        }  else {
            return FALSE;
        }
    }
}
?>