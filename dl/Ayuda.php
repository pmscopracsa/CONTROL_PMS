<?php
require_once 'Conexion.php';

class Ayuda {
    private $_nombre_usuario;
    private $_nombre_tabla;
    private $_nombre_campo;

    public function existeUsuario() 
    {
        $query = "SELECT * FROM $this->_nombre_tabla WHERE $this->_nombre_campo = '$this->_nombre_usuario'";
        
        try {
            $conn = new Conexion();
            $cn = $conn->conectar();
            
            if (!$cn)
                throw new Exception("Error al conectar con la db: ".  mysql_error());
            
            $rs = mysql_query($query,$cn);
            
            if (!$rs) 
                throw new Exception("Error en la consulta: ".  mysql_error());
            
            $rows = mysql_num_rows($rs);
            
            if ($rows > 0)
                echo "existe";
            else
                echo 'no existe';
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
    
    /*
     * G&S
     */
    public function get_nombre_usuario() {
        return $this->_nombre_usuario;
    }

    public function set_nombre_usuario($_nombre_usuario) {
        $this->_nombre_usuario = $_nombre_usuario;
    }

    public function get_nombre_tabla() {
        return $this->_nombre_tabla;
    }

    public function set_nombre_tabla($_nombre_tabla) {
        $this->_nombre_tabla = $_nombre_tabla;
    }
    
    public function get_nombre_campo() {
        return $this->_nombre_campo;
    }

    public function set_nombre_campo($_nombre_campo) {
        $this->_nombre_campo = $_nombre_campo;
    }
}