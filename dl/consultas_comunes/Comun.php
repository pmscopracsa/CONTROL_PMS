<?php
include_once '../Conexion.php';

class Comun 
{
    protected $_nombreTabla;
    protected $_id;
    
    public function __construct() {

    }
    
    public function obtenerUltimoId(){
        $conex = new Conexion();
        $cone = $conex->conectar();
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
    
    public function retornaTabla(){
        $conex = new Conexion();
        $cone = $conex->conectar();
        $query = "SELECT * FROM ".$this->_nombreTabla." WHERE id=".$this->_id;
        $rs;
        
        try {
            $rs = mysql_query($query);
        } catch(Exception $exc) {
            echo "Error en consulta";
        }
        return $rs;
    }
    
    public function get_nombreTabla() {
        return $this->_nombreTabla;
    }

    public function set_nombreTabla($_nombreTabla) {
        $this->_nombreTabla = $_nombreTabla;
    }
    
    public function get_id() {
        return $this->_id;
    }

    public function set_id($_id) {
        $this->_id = $_id;
    }
}