<?php
require_once 'Conexion.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DirectoriosDL
 *
 * @author root
 */
class DirectoriosDL 
{
    protected $_id;
    protected $_descripcion;
    protected $_nombre;
    
    public function mostrarDirectorio()
    {
        $query = "SELECT nombre,descripcion FROM tb_directorio WHERE tb_empresa_id = $this->_id ORDER BY nombre ASC";
        
        try {
            $conexion = new Conexion();
            $cn = $conexion->conectar();
            $rs = mysql_query($query,$cn);
            $registros = array();
            while($reg = mysql_fetch_array($rs))
            {
                array_push($registros,$reg);
            }
            mysql_free_result($rs);
            mysql_close($cn);
        } catch (Exception $exc) {
            try {
                mysql_free_result($rs);
            } catch(Exception $e1){}
            try {
                mysql_close($cn);
            }catch(Exception $e1){}
        }
    return $registros;    
    }
    
    public function mostrarDirectorioPorNombre()
    {
        $query = "SELECT nombre,descripcion FROM tb_directorio WHERE nombre LIKE '$this->_nombre'";
        
        try {
            $conexion = new Conexion();
            $cn = $conexion->conectar();
            $rs = mysql_query($query,$cn);
            $registros = array();
            while($reg = mysql_fetch_array($rs))
            {
                array_push($registros,$reg);
            }
            mysql_free_result($rs);
            mysql_close($cn);
        } catch (Exception $exc) {
            try {
                mysql_free_result($rs);
            } catch(Exception $e1){}
            try {
                mysql_close($cn);
            }catch(Exception $e1){}
        }
    return $registros;    
    }
    
    /**
     * G & S 
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
    
    public function get_nombre() {
        return $this->_nombre;
    }

    public function set_nombre($_nombre) {
        $this->_nombre = $_nombre;
    }
}