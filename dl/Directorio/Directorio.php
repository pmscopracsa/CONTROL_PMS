<?php

class Directorio {
    private $_id;
    private $_nombre;
    private $_descripcion;
    private $_tb_empresa_id;
    
    // G & S
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

    public function get_descripcion() {
        return $this->_descripcion;
    }

    public function set_descripcion($_descripcion) {
        $this->_descripcion = $_descripcion;
    }

    public function get_tb_empresa_id() {
        return $this->_tb_empresa_id;
    }

    public function set_tb_empresa_id($_tb_empresa_id) {
        $this->_tb_empresa_id = $_tb_empresa_id;
    }
}