<?php
require_once 'Conexion.php';

class PartidaVenta 
{
    protected $_id;
    protected $_codificacion;
    protected $_descripcion;
    protected $_unidadmedida;
    protected $_metrado;
    protected $_precio;
    protected $_parcial;
    protected $_tb_faseventa_id;
    
    public function c_partidaventa()
    {
        $query = "INSERT INTO `tb_partidaventa`
            (`id`, `codificacion`, `descripcion`, `unidadmedida`, `metrado`, `precio`, `parcial`, `tb_faseventa_id`) 
            VALUES (
            NULL
            ,'$this->_codificacion'
            ,'$this->_descripcion'
            ,'$this->_unidadmedida'
            ,$this->_metrado
            ,$this->_precio
            ,$this->_parcial
            ,$this->_tb_faseventa_id)";
        
        try {
            $con = new Conexion();
            $cn = $con->conectar();
            
            if (!$cn)
                throw new Exception("Error al conectar: ".  mysql_error());
            
            $rs = mysql_query($query,$cn);
            
            if (!$rs)
                throw new Exception("Error al consultar: ".  mysql_error());
        } catch(Exception $ex) {
            echo "Error: ".$ex->getMessage();
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

    public function get_codificacion() {
        return $this->_codificacion;
    }

    public function set_codificacion($_codificacion) {
        $this->_codificacion = $_codificacion;
    }

    public function get_descripcion() {
        return $this->_descripcion;
    }

    public function set_descripcion($_descripcion) {
        $this->_descripcion = $_descripcion;
    }

    public function get_unidadmedida() {
        return $this->_unidadmedida;
    }

    public function set_unidadmedida($_unidadmedida) {
        $this->_unidadmedida = $_unidadmedida;
    }

    public function get_metrado() {
        return $this->_metrado;
    }

    public function set_metrado($_metrado) {
        $this->_metrado = $_metrado;
    }

    public function get_precio() {
        return $this->_precio;
    }

    public function set_precio($_precio) {
        $this->_precio = $_precio;
    }

    public function get_parcial() {
        return $this->_parcial;
    }

    public function set_parcial($_parcial) {
        $this->_parcial = $_parcial;
    }

    public function get_tb_faseventa_id() {
        return $this->_tb_faseventa_id;
    }

    public function set_tb_faseventa_id($_tb_faseventa_id) {
        $this->_tb_faseventa_id = $_tb_faseventa_id;
    }
}