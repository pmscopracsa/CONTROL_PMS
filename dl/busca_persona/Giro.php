<?php
require_once 'Conexion.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Giro
 *
 * @author root
 */
class Giro 
{
    protected $_id;
    protected $_descripcion;
    protected $_tb_compania_id;
    protected $_tb_empresa_id;
    
    public function r_obtenerGiro()
    {
        
    }
    
    public function r_obtenerGirosPorCompania()
    {
        $query = "SELECT 
        g.id id
        ,g.descripcion descripcion
        FROM tb_companiacontacto cc
        INNER JOIN tb_giro g ON cc.id = g.tb_compania_id
        WHERE cc.tb_empresa_id = $this->_tb_empresa_id AND cc.id = $this->_tb_compania_id";
        
        try {
            $conn = new Conexion();
            $cn = $conn->conectar();
            
            if (!$cn)
                throw new Exception("Error al conectar: ".  mysql_error());
            
            $sql = mysql_query($query,$cn);
            
            if (!$cn)
                throw new Exception("Error en consulta: ".  mysql_error());
            
            $giros = array();
            $i=0;
            while ($res = mysql_fetch_array($sql,MYSQL_ASSOC))
            {
                array_push($giros, $res['id']);
                array_push($giros, $res['descripcion']);
            }
            while($res = mysql_fetch_assoc($sql)) {
                $giros[$i]['id'] = $res['id'];
                $giros[$i]['descripcion'] = $res['descripcion'];
                $i++;
            }
            return $giros;
            
        } catch (Exception $ex) {
            echo 'Error: '.$ex->getMessage();
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

    public function get_descripcion() {
        return $this->_descripcion;
    }

    public function set_descripcion($_descripcion) {
        $this->_descripcion = $_descripcion;
    }

    public function get_tb_compania_id() {
        return $this->_tb_compania_id;
    }

    public function set_tb_compania_id($_tb_compania_id) {
        $this->_tb_compania_id = $_tb_compania_id;
    }
    
    public function get_tb_empresa_id() {
        return $this->_tb_empresa_id;
    }

    public function set_tb_empresa_id($_tb_empresa_id) {
        $this->_tb_empresa_id = $_tb_empresa_id;
    }
}