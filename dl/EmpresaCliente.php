<?php
require_once 'Conexion.php';

class EmpresaCliente {
    private $_id;
    private $_nombre;
    private $_password;
    private $_logo;
    
    public function listarEmpresas() {
        
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
}