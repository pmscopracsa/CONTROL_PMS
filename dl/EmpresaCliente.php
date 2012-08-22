<?php
require_once 'Conexion.php';

class EmpresaCliente {
    private $_id;
    private $_nombre;
    private $_password;
    private $_logo;
    private $_direccion;
    
    public function listarEmpresas() {
        
    }
    
    public function existePassword($cn) {
        $rs = "";
        $query = "SELECT * FROM tb_empresa WHERE id = $this->_id AND password = '$this->_password'";
        
        $rs = mysql_query($query,$cn);
        
        if (@mysql_num_rows($rs) == 1)
            $rs = "correcto";
        else
            $rs = "incorrecto";
        
        return $rs;
    }
    
    public function resetPassword($cn) {
        $res = "";
        $query = "UPDATE tb_empresa SET password = '$this->_password' WHERE id = $this->_id";
        
        $rs = mysql_query($query, $cn);
        
        if ($rs)
            $res = "correcto";
        else
            $res = "incorrecto";
        
        return $res;
    }
    
    public function updateName($cn) {
        $query = "UPDATE tb_empresa SET nombre = '$this->_nombre' WHERE id = $this->_id";
        try {
            $rs = mysql_query($query,$cn);
            if (!$rs)
                throw new Exception("Error en la consulta: ".  mysql_error());
        } catch(Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
    }
    
    public function updateAddress($cn) {
        $query = "UPDATE tb_empresa SET direccion = '$this->_direccion' WHERE id = $this->_id";
        try {
            $rs = mysql_query($query,$cn);
            if (!$rs)
                throw new Exception("Error en la consulta: ".  mysql_error());
        } catch(Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
    }
    // G&S
    public function get_id() {
        return $this->_id;
    }

    public function set_id($_id) {
        $this->_id = $_id;
    }

    public function get_nombre() {
        return $this->_nombre;
    }

    public function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }

    public function get_password() {
        return $this->_password;
    }

    public function set_password($_password) {
        $this->_password = $_password;
    }

    public function get_logo() {
        return $this->_logo;
    }

    public function set_logo($_logo) {
        $this->_logo = $_logo;
    }
    
    public function get_direccion() {
        return $this->_direccion;
    }

    public function set_direccion($_direccion) {
        $this->_direccion = $_direccion;
    }
}