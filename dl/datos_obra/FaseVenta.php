<?php
require_once 'Conexion.php';

class FaseVenta 
{
    protected $_id;
    protected $_codificacion;
    protected $_descripcion;
    protected $_tb_seccionventa_id;
    
    public function c_faseventa()
    {
        $query = "INSERT INTO fasetemporal (id,codificacion,descripcion) VALUES(
            NULL
            ,'$this->_codificacion'
            ,'$this->_descripcion'
            ,$this->_tb_seccionventa_id)";
        
        try {
            $con = new Conexion();
            $cn = $con->conectar();
            
            if (!$cn)
                throw new Exception("Error al conectar:".  mysql_error());
            
            $rs = mysql_query($query,$cn);
            
            if (!$rs)
                throw new Exception("Error al consultar: ".  mysql_error());
        } catch (Exception $ex) {
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

    public function get_tb_seccionventa_id() {
        return $this->_tb_seccionventa_id;
    }

    public function set_tb_seccionventa_id($_tb_seccionventa_id) {
        $this->_tb_seccionventa_id = $_tb_seccionventa_id;
    }
}