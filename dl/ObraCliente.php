<?php
//require_once 'Conexion.php';

class ObraCliente {
    private $_id;
    private $_codigoobra;
    private $_descripcion;
    private$_tb_directorio_id;
    
    /**
     * CARGAS 
     */
    public function cargarObras() {
        //$query = "SELECT id,descripcion FROM tb_obra WHERE tb_directorio = $this->_tb_directorio_id";
        $query = "SELECT id,descripcion FROM tb_obra";
        
        try {
            $cone = new Conexion();
            $cn = $cone->conectar();
            
            if (!$cn)
                throw new Exception("Error de conexion: ".  mysql_error());
            
            $rs = mysql_query($query);
            if (!$rs)
                throw new Exception("Error en consulta: ".  mysql_error());
            
            if (@mysql_num_rows($rs) > 0) {
                $obras = array();
                
                while ($obra = mysql_fetch_assoc($rs)) {
                    $id = $obra['id'];
                    $descripcion = $obra['descripcion'];
                    $obras[$id] = $descripcion;
                }
                return $obras;
            } else {
                return FALSE;
            }
        
        } catch (Exception $ex) {
            echo 'Error:'.$ex->getMessage();
        }
    }
    
    /**
     * G&S 
     */
    public function get_id() {
        return $this->_id;
    }

    public function set_id($_id) {
        $this->_id = $_id;
    }

    public function get_codigoobra() {
        return $this->_codigoobra;
    }

    public function set_codigoobra($_codigoobra) {
        $this->_codigoobra = $_codigoobra;
    }

    public function get_descripcion() {
        return $this->_descripcion;
    }

    public function set_descripcion($_descripcion) {
        $this->_descripcion = $_descripcion;
    }

    public function get_tb_directorio_id() {
        return $this->_tb_directorio_id;
    }

    public function set_tb_directorio_id($_tb_directorio_id) {
        $this->_tb_directorio_id = $_tb_directorio_id;
    }
}