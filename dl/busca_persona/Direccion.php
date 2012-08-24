<?php
require_once 'Conexion.php';

class Direccion {
    private $_ruc;
    
    public function obtenerDireccionesPorCompania() {
        $query = "SELECT dcc.direccion
        FROM tb_companiacontacto cc
        INNER JOIN tb_direccioncompaniacontacto dcc ON cc.id = dcc.tb_companiacontacto_id
        WHERE cc.ruc = '$this->_ruc'";
        
        try {
            $cnx = new Conexion();
            $cn = $cnx->conectar();
            if (!$cn)
                throw new Exception("Error al conectar: ".  mysql_error());
            
            $rs = mysql_query($query, $cn);
            if (!$rs)
                throw new Exception("Error al consultar: ".  mysql_error());
            
            $datos = array();
            
            while ($res = mysql_fetch_array($rs,MYSQL_ASSOC)) {
                array_push($datos,$res['numero']);
            }
            return $datos;
            
        } catch(Exception $ex) {
            echo 'Error: '.$ex->getMessage();
        }
    }
    
    /**
     * G & S 
     */
    public function get_ruc() {
        return $this->_ruc;
    }

    public function set_ruc($_ruc) {
        $this->_ruc = $_ruc;
    }
}