<?php
//define('__ROOT__', dirname(dirname(__FILE__)));
require_once __ROOT__.'/Conexion.php';
    
class Session {
    private $_id_empresa;
    private $_id_usuario;
    private $_id_session;
    private $_id_rol;
    
    public function guardarDirectorioObraSeteoTrabajo() {
        $query = "INSERT INTO tb_session(id_empresa,id_usuario,id_session,id_rol,fecha)VALUES(
                $this->_id_empresa
                ,$this->_id_usuario
                ,$this->_id_session
                ,$this->_id_rol
                ,NOW()
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

    public function get_id_session() {
        return $this->_id_session;
    }

    public function set_id_session($_id_session) {
        $this->_id_session = $_id_session;
    }

    public function get_id_rol() {
        return $this->_id_rol;
    }

    public function set_id_rol($_id_rol) {
        $this->_id_rol = $_id_rol;
    }

    public function get_fecha() {
        return $this->_fecha;
    }

    public function set_fecha($_fecha) {
        $this->_fecha = $_fecha;
    }
}