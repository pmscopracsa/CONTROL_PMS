<?php
include_once '../Conexion.php';

class Comun 
{
    protected $_nombreTabla;
    
    public function __construct() {
        $conex = new Conexion();
        $cone = $conex->conectar();
        return $cone;
    }
    
    public function obtenerUltimoId(){
        $id = 0;
        
        $consulta = "SELECT id FROM ".$this->_nombreTabla." ORDER BY id DESC LIMIT 1";
        $rs = mysql_query($consulta);
        
        $resultados = mysql_num_rows($rs);
        
        if ($resultados == 0) {
            $id = 1;
        } else {
            while ($reg = mysql_fetch_array($rs)) {
                $id = $reg['id'];
                break;
            }
        }
        return $id;
    }
    
    public function get_nombreTabla() {
        return $this->_nombreTabla;
    }

    public function set_nombreTabla($_nombreTabla) {
        $this->_nombreTabla = $_nombreTabla;
    }
}

?>
