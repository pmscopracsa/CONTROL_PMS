<?php
//require_once 'Conexion.php';
define('__ROOT__', dirname(dirname(__FILE__)));
require_once __ROOT__.'/Conexion.php';

class SeccionVenta 
{
    private $_id;
    private $_codificacion;
    private $_descripcion;
    private $_empresa_id;
    private $_directorio_id;
    private $_tb_obra_id;
    
    public function c_seccionventa()
    {
        $sql = "INSERT INTO secciontemporal(id,codificacion,descripcion,tb_obra_id) VALUES(
            NULL
            ,'$this->_codificacion'
            ,'$this->_descripcion'
            ,$this->_tb_obra_id)";
        
        try {
            $con = new Conexion();
            $cn = $con->conectar();
            
            if (!$cn)
                throw new Exception("Error al conectar: ".  mysql_error());
            
            $rs = mysql_query($sql,$cn);
            
            if (!$rs)
                throw new Exception("Error en la consulta: ".  mysql_error());
            
        } catch(Exception $ex) {
            echo "Error: ".$ex->getMessage();
        }
    }
    
    public function obtenerSecciones() {
        $sql = "SELECT 
                sv.id sv_id
                ,sv.codificacion sv_codificacion
                ,sv.descripcion sv_descripcion
                ,sv.tb_obra_id sv_tb_obra_id
                FROM tb_empresa e
                INNER JOIN tb_directorio d ON e.id = d.tb_empresa_id
                INNER JOIN tb_obra o ON d.id = tb_directorio_id
                INNER JOIN tb_seccionventa sv ON o.id = sv.tb_obra_id
                WHERE e.id = $this->_empresa_id AND d.id = $this->_directorio_id AND o.id = $this->_tb_obra_id";
        
        try {
            $con = new Conexion();
            $cn = $con->conectar();
            
            if (!$cn)
                throw new Exception("Error al conectar: ".  mysql_error());
            
            $rs = mysql_query($sql,$cn);
            
            if (!$rs)
                throw new Exception("Error en la consulta: ".  mysql_error());
            
            $secciones = array();
            $i = 0;
            while ($row = mysql_fetch_array($rs, MYSQLI_ASSOC)) {
                $secciones[$i]['sv_id'] = $row['sv_id'];
                $secciones[$i]['sv_codificacion'] = $row['sv_codificacion'];
                $secciones[$i]['sv_descripcion'] = $row['sv_descripcion'];
                $i++;
            }
            return json_encode($secciones);
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
    
    public function get_tb_obra_id() {
        return $this->_tb_obra_id;
    }

    public function set_tb_obra_id($_tb_obra_id) {
        $this->_tb_obra_id = $_tb_obra_id;
    }
    
    public function get_empresa_id() {
        return $this->_empresa_id;
    }

    public function set_empresa_id($_empresa_id) {
        $this->_empresa_id = $_empresa_id;
    }

    public function get_directorio_id() {
        return $this->_directorio_id;
    }

    public function set_directorio_id($_directorio_id) {
        $this->_directorio_id = $_directorio_id;
    }
}