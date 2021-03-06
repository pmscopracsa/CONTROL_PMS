<?php
require_once 'Conexion.php';

class TelefonoNextel {
    private $_id;
    private $_numero;
    private $_tb_companiacontacto_id;
    private $_tb_personacontacto_id;
    private $_ruc;
    
    public function obtenerTelefonosPorCompania(){
        $query = "SELECT 
                tm.id
                ,tm.numero 
                FROM 
                tb_companiacontacto cc INNER JOIN tb_telefononextelcompania tm ON cc.id = tm.tb_companiacontacto_id
                WHERE cc.ruc = '$this->_ruc'";
        
        try {
            $cnx = new Conexion();
            $cn = $cnx->conectar();
            if (!$cn)
                throw new Exception("Error al conectar: ".  mysql_error());
            
            $rs = mysql_query($query, $cn);
            if (!$rs)
                throw new Exception("Error al consultar: ".  mysql_error());
            
            $telefonos = array();
            
            while ($res = mysql_fetch_array($rs,MYSQL_ASSOC)) {
                array_push($telefonos,$res['id']);
                array_push($telefonos,$res['numero']);
            }
            return $telefonos;
            
        } catch(Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
    }
    
    public function obtenerTelefonosPorPersona(){
        $query = "SELECT 
                id
                ,numero 
                FROM 
                tb_telefononextelpersona WHERE tb_personacontacto_id = $this->_tb_personacontacto_id";
        
        try {
            $cnx = new Conexion();
            $cn = $cnx->conectar();
            if (!$cn)
                throw new Exception("Error al conectar: ".  mysql_error());
            
            $rs = mysql_query($query, $cn);
            if (!$rs)
                throw new Exception("Error al consultar nextel: ".  mysql_error());
            
            $telefonos = array();
            
            while ($res = mysql_fetch_array($rs,MYSQL_ASSOC)) {
                array_push($telefonos,$res['id']);
                array_push($telefonos,$res['numero']);
            }
            return $telefonos;
            
        } catch(Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
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

    public function get_numero() {
        return $this->_numero;
    }

    public function set_numero($_numero) {
        $this->_numero = $_numero;
    }

    public function get_tb_companiacontacto_id() {
        return $this->_tb_companiacontacto_id;
    }

    public function set_tb_companiacontacto_id($_tb_companiacontacto_id) {
        $this->_tb_companiacontacto_id = $_tb_companiacontacto_id;
    }
    
    public function get_ruc() {
        return $this->_ruc;
    }

    public function set_ruc($_ruc) {
        $this->_ruc = $_ruc;
    }
    
    public function get_tb_personacontacto_id() {
        return $this->_tb_personacontacto_id;
    }

    public function set_tb_personacontacto_id($_tb_personacontacto_id) {
        $this->_tb_personacontacto_id = $_tb_personacontacto_id;
    }
}