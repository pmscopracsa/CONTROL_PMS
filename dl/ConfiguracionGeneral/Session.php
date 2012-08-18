<?php
//define('__ROOT__', dirname(dirname(__FILE__)));
require_once __ROOT__.'/Conexion.php';
    
class Session {
    private $_id_empresa;
    private $_id_usuario;
    private $_directorio;
    private $_obra;        
    
    public function guardarDirectorioObraSeteoTrabajo() {
        $rs = "yes";
        $query = "INSERT INTO tb_session(id_empresa,id_usuario,fecha,directorio,obra)VALUES(
                $this->_id_empresa
                ,$this->_id_usuario
                ,NOW()
                ,$this->_directorio
                ,$this->_obra
                )";
        
        try {
            $conexion = new Conexion();
            $cn = $conexion->conectar();
            
            if (!$cn)
                throw new Exception("Error en la conexion: ".  mysql_error());
            
            $rs = mysql_query($query, $cn);
            
            if (!$rs)
                throw new Exception("Error en la consulta: ".  mysql_error());
            
        } catch (Exception $ex) {
            echo "Error: ".$ex->getMessage();
        }
        return $rs;
    }
    /**
     * G&S 
     */
    public function get_id_empresa() {
        return $this->_id_empresa;
    }

    public function set_id_empresa($_id_empresa) {
        $this->_id_empresa = $_id_empresa;
    }

    public function get_id_usuario() {
        return $this->_id_usuario;
    }

    public function set_id_usuario($_id_usuario) {
        $this->_id_usuario = $_id_usuario;
    }

    public function get_fecha() {
        return $this->_fecha;
    }

    public function set_fecha($_fecha) {
        $this->_fecha = $_fecha;
    }
    
    public function get_directorio() {
        return $this->_directorio;
    }

    public function set_directorio($_directorio) {
        $this->_directorio = $_directorio;
    }

    public function get_obra() {
        return $this->_obra;
    }

    public function set_obra($_obra) {
        $this->_obra = $_obra;
    }
}