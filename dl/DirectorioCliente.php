<?php
require_once 'Conexion.php';

class DirectorioCliente {
    private $_id;
    private $_nombre;
    private $_descripcion;
    private $_tb_empresa_id;
    
    public function crearDirectorio($cn){
        $sql = "INSERT INTO tb_directorio (id,nombre,descripcion,tb_empresa_id) VALUES(
            NULL
            ,'$this->_nombre'
            ,'$this->_descripcion'
            ,$this->_tb_empresa_id)";
        
        try {
            $rs = mysql_query($sql,$cn);
            if(!$rs)
                throw new Exception("Error en consulta".  mysql_error());
        } catch (Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
    }
    
    public function listarDirectorios($cn) {
        $query = "SELECT * FROM tb_directorio WHERE tb_empresa_id = $this->_tb_empresa_id";
        
        try {
            $rs = mysql_query($query, $cn);
            if (!$rs)
                throw new Exception("Error en consulta: ".  mysql_error());
            
            $directorios = array();
            
            while ($reg = mysql_fetch_array($rs)) {
                array_push($directorios, $reg);
            }
            return $directorios;
        } catch(Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
    }


    /*
     * G&S
     */
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