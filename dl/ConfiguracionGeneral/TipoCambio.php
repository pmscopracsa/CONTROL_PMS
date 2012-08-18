<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once __ROOT__.'/Conexion.php';

class TipoCambio 
{
    protected $_id;
    protected $_fecha;
    protected $_sunatventa;
    protected $_sunatcompra;
    protected $_tb_moneda_id;
    protected $_bancoventa;
    protected $_tb_empresa_id;
    
    public function c_tipocambio()
    {
        $query = "INSERT INTO tb_tipodecambio 
        (id,fecha,sunatventa,sunatcompra,tb_moneda_id,tb_empresa_id) VALUES(
        NULL
        ,CURDATE()
        ,$this->_sunatventa
        ,$this->_sunatcompra
        ,$this->_tb_moneda_id
        ,$this->_tb_empresa_id
        )";
        
        try {
            $conexion = new Conexion();
            $cn = $conexion->conectar();
            
            if (!$cn)
                throw new Exception("Error en la conexión: ".  mysql_error());
            
            $rs = mysql_query($query, $cn);
            
            if (!$rs)
                throw new Exception("Error en la consulta: ".  mysql_error());
            
        } catch (Exception $ex){
            echo "Error: ".$ex->getMessage();
        }  
    }
    
    public function u_tipocambio()
    {
        
    }
    
    public function r_tipocambio()
    {
        $query = "SELECT 
        sunatventa
        ,sunatcompra
        FROM tb_tipodecambio WHERE fecha = CURDATE() AND  tb_empresa_id = $this->_tb_empresa_id";
        
        try {
            $conexion = new Conexion();
            $cn = $conexion->conectar();
            
            if (!$cn)
                throw new Exception("Error en la conexion: ".  mysql_error());
            
            $rs = mysql_query($query, $cn);
            
            if (!$rs)
                throw new Exception("Error en la consulta: ".  mysql_error());
            
            $cambio = array();
            while ($reg = mysql_fetch_array($rs)) {
                array_push($cambio, $reg['sunatventa']);
                array_push($cambio, $reg['sunatcompra']);
            }
            return $cambio;
        } catch (Exception $ex) {
            echo "Error: ".$ex->getMessage();
        }
    }
    
    public function existecambio()
    {
        $query = "SELECT * FROM tb_tipodecambio WHERE fecha = CURDATE() AND  tb_empresa_id = $this->_tb_empresa_id";
        
        try {
            $conexion = new Conexion();
            $cn = $conexion->conectar();
            
            if (!$cn)
                throw new Exception("Error en la conexion: ".  mysql_error());
            
            $rs = mysql_query($query, $cn);
            
            if (!$rs)
                throw new Exception("Error en la consulta: ".  mysql_error());
            
            if (mysql_num_rows($rs) > 0) {
                echo "already";
                exit;
            }
            elseif (mysql_num_rows($rs) == 0) {
                echo "notyet";
                exit;
            }
            
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

    public function get_fecha() {
        return $this->_fecha;
    }

    public function set_fecha($_fecha) {
        $this->_fecha = $_fecha;
    }

    public function get_sunatventa() {
        return $this->_sunatventa;
    }

    public function set_sunatventa($_sunatventa) {
        $this->_sunatventa = $_sunatventa;
    }

    public function get_sunatcompra() {
        return $this->_sunatcompra;
    }

    public function set_sunatcompra($_sunatcompra) {
        $this->_sunatcompra = $_sunatcompra;
    }

    public function get_tb_moneda_id() {
        return $this->_tb_moneda_id;
    }

    public function set_tb_moneda_id($_tb_moneda_id) {
        $this->_tb_moneda_id = $_tb_moneda_id;
    }

    public function get_bancoventa() {
        return $this->_bancoventa;
    }

    public function set_bancoventa($_bancoventa) {
        $this->_bancoventa = $_bancoventa;
    }

    public function get_tb_empresa_id() {
        return $this->_tb_empresa_id;
    }

    public function set_tb_empresa_id($_tb_empresa_id) {
        $this->_tb_empresa_id = $_tb_empresa_id;
    }
}